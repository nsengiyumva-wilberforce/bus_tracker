<x-app-layout>
    <div class="row">
        <div id="map" style="height: 80vh;"></div>
    </div>
</x-app-layout>

<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

<script>
    var map = L.map('map').setView([0, 0], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    var busRoutes = {};

    // Request notification permissions
    if ("Notification" in window && Notification.permission !== "granted") {
        Notification.requestPermission();
    }

    @foreach ($buses as $bus)
        (function() {
            const busId = {{ $bus->id }};
            const start = [{{ $bus->route->startingStation->latitude }}, {{ $bus->route->startingStation->longitude }}];
            const end = [{{ $bus->route->endingStation->latitude }}, {{ $bus->route->endingStation->longitude }}];

            const routeControl = L.Routing.control({
                waypoints: [L.latLng(start), L.latLng(end)],
                show: false,
                addWaypoints: false,
                draggableWaypoints: false,
                lineOptions: { styles: [{ color: '#3388ff', opacity: 0.7, weight: 5 }] }
            }).addTo(map);

            const busMarker = L.marker(start, {
                icon: L.divIcon({
                    className: 'bus-marker',
                    html: '<div class="bus-icon">🚌</div>',
                    iconSize: [30, 30]
                })
            }).addTo(map).bindPopup('Loading route...');

            busMarker.on('popupopen', () => updateBusPopup(busId, busMarker, currentPosition));

            routeControl.on('routesfound', function(e) {
                const route = e.routes[0];
                const coordinates = route.coordinates;
                const cumulativeDistances = [0];
                
                for (let i = 1; i < coordinates.length; i++) {
                    cumulativeDistances.push(cumulativeDistances[i-1] + 
                        L.latLng(coordinates[i-1]).distanceTo(L.latLng(coordinates[i])));
                }

                // Segment the route into ~100m chunks with historical speeds
                const segments = [];
                let currentStart = 0;
                const now = new Date();
                const historicalSpeed = (now.getHours() >= 7 && now.getHours() < 9) ? 8 : 12;

                for (let i = 1; i < cumulativeDistances.length; i++) {
                    if (cumulativeDistances[i] - cumulativeDistances[currentStart] >= 100) {
                        segments.push({
                            startIndex: currentStart,
                            endIndex: i-1,
                            startDistance: cumulativeDistances[currentStart],
                            endDistance: cumulativeDistances[i-1],
                            historicalSpeed: historicalSpeed
                        });
                        currentStart = i;
                    }
                }
                segments.push({
                    startIndex: currentStart,
                    endIndex: cumulativeDistances.length-1,
                    startDistance: cumulativeDistances[currentStart],
                    endDistance: cumulativeDistances[cumulativeDistances.length-1],
                    historicalSpeed: historicalSpeed
                });

                busRoutes[busId] = {
                    coordinates,
                    cumulativeDistances,
                    totalDistance: cumulativeDistances[cumulativeDistances.length-1],
                    segments,
                    totalTime: route.summary.totalTime,
                    instructions: route.instructions
                };

                if (busMarker.isPopupOpen()) updateBusPopup(busId, busMarker, currentPosition);
            });

            let currentPosition = 0, prevPosition = 0;
            const previousETAs = {};

            setInterval(() => {
                if (!busRoutes[busId]) return;
                prevPosition = currentPosition;
                currentPosition = (currentPosition + 1) % busRoutes[busId].coordinates.length;
                
                busMarker.setLatLng(busRoutes[busId].coordinates[currentPosition]);
                if (busMarker.isPopupOpen()) updateBusPopup(busId, busMarker, currentPosition);
                
                if (currentPosition === busRoutes[busId].coordinates.length - 1 && !busRoutes[busId].notified) {
                    showBusArrivalNotification(busId);
                    busRoutes[busId].notified = true;
                }
            }, 10000);

            function updateBusPopup(busId, marker, currentPos) {
                const route = busRoutes[busId];
                if (!route) return marker.getPopup().setContent('Loading...');

                // Calculate metrics
                const traveled = route.cumulativeDistances[currentPos];
                const remaining = route.totalDistance - traveled;
                const prevCoord = L.latLng(route.coordinates[prevPosition]);
                const currCoord = L.latLng(route.coordinates[currentPos]);
                const speedMps = prevCoord.distanceTo(currCoord) / 10;
                const speedKph = (speedMps * 3.6).toFixed(1);

                // Enhanced ETA calculation
                let remainingTime = 0;
                const currentDist = route.cumulativeDistances[currentPos];
                const currentSegment = route.segments.find(s => 
                    currentDist >= s.startDistance && currentDist <= s.endDistance);
                
                if (currentSegment) {
                    const S_y = currentSegment.endDistance - currentDist;
                    const S_a = currentDist - currentSegment.startDistance;
                    const weightSum = S_y + S_a;
                    const v_i = weightSum > 0 ? 
                        (S_y * speedMps + S_a * currentSegment.historicalSpeed) / weightSum :
                        currentSegment.historicalSpeed;
                    
                    remainingTime += S_y / v_i;

                    const segIndex = route.segments.indexOf(currentSegment);
                    for (let i = segIndex + 1; i < route.segments.length; i++) {
                        const seg = route.segments[i];
                        remainingTime += (seg.endDistance - seg.startDistance) / seg.historicalSpeed;
                    }
                }

                const eta = new Date(Date.now() + remainingTime * 1000).toLocaleTimeString();
                previousETAs[busId] = eta;

                // Build full popup content
                let content = `<h5>Bus ${busId} Status</h5>
                    <div class="metrics">
                        <div>Traveled: ${(traveled/1000).toFixed(2)} km</div>
                        <div>Remaining: ${(remaining/1000).toFixed(2)} km</div>
                        <div>Speed: ${speedKph} km/h</div>
                        <div>ETA: ${eta}</div>
                    </div><hr><h5>Directions</h5><div class="directions-list">`;

                // Add instructions with current step highlighting
                const currentInstrIndex = getCurrentInstructionIndex(currentPos, route.instructions);
                route.instructions.forEach((instruction, index) => {
                    content += `<div class="direction-step ${index === currentInstrIndex ? 'current-step' : ''}">
                        ${instruction.text}
                    </div>`;
                });
                content += '</div>';

                marker.getPopup().setContent(content).update();
            }

            function getCurrentInstructionIndex(currentPos, instructions) {
                for (let i = 0; i < instructions.length; i++) {
                    const instr = instructions[i];
                    const nextStart = (i < instructions.length - 1) ? 
                        instructions[i + 1].index : Infinity;
                    if (currentPos >= instr.index && currentPos < nextStart) return i;
                }
                return 0;
            }

        })();
    @endforeach

    function showBusArrivalNotification(busId) {
        if ("Notification" in window && Notification.permission === "granted") {
            new Notification(`Bus ${busId} has reached its destination!`);
        } else {
            alert(`Bus ${busId} has reached its destination!`);
        }
    }
</script>

<style>
    .direction-step {
        padding: 4px 8px;
    }
    .direction-step.current-step {
        background-color: #e0f0ff;
        font-weight: bold;
        border-left: 3px solid #3388ff;
    }
    .metrics div {
        margin: 4px 0;
    }
</style>