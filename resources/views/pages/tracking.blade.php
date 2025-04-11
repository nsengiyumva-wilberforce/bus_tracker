<x-app-layout>
    <div class="row">
        <div id="map" style="height: 80vh;" class="col-9"></div>
        <div id="location-info" class="leaflet-control leaflet-bar col-3" style="padding: 10px; background: white;">
            <p>Coordinates: <span id="coordinates"></span></p>
            <p>Speed: <span id="speed"></span></p>
            <p>Address: <span id="address">Loading...</span></p>

            <div id="bus-controls">
                <!-- Search bar for buses -->
                <div id="bus-search" style="margin-bottom: 10px;">
                    <input type="text" id="search-bus" placeholder="Search for a bus..."
                        style="width: 100%; padding: 5px; border: 1px solid #ccc; border-radius: 3px;">
                </div>

                <!-- Dropdown for selecting a bus -->
                <label for="bus-select">Select Bus:</label>
                <select id="bus-select">
                    <option value="" disabled selected>Select a bus</option>
                    @foreach ($buses as $bus)
                        <option value="{{ $bus->id }}">Bus {{ $bus->bus_number }}</option>
                    @endforeach
                </select>

                <!-- Buttons for moving the selected bus -->
                <div id="direction-buttons" style="margin-top: 10px;">
                    <button class="move-bus" data-direction="north" title="Move North">
                        <i class="fas fa-arrow-up"></i>
                    </button>
                    <button class="move-bus" data-direction="south" title="Move South">
                        <i class="fas fa-arrow-down"></i>
                    </button>
                    <button class="move-bus" data-direction="east" title="Move East">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                    <button class="move-bus" data-direction="west" title="Move West">
                        <i class="fas fa-arrow-left"></i>
                    </button>
                </div>

                <!-- Jump to Destination Button -->
                <button class="move-bus" id="jump-to-destination" title="Jump to Destination">
                    <i class="fas fa-flag-checkered"></i>
                </button>
            </div>

            <!-- Legend for map markers -->
            <div id="map-legend"
                style="margin-top: 10px; padding: 10px; background: white; border: 1px solid #ccc; border-radius: 5px;">
                <h4>Legend</h4>
                <p><span style="color: red;">●</span> Bus Location</p>
                <p><span style="color: blue;">●</span> Your Location</p>
            </div>

            <!-- Dark mode toggle -->
            <div id="dark-mode-toggle" style="margin-top: 10px;">
                <label>
                    <input type="checkbox" id="toggle-dark-mode"> Dark Mode
                </label>
            </div>

            <!-- Real-time clock -->
            <div id="real-time-clock" style="margin-top: 10px; font-size: 16px; font-weight: bold;"></div>
        </div>
    </div>
</x-app-layout>

<!-- Leaflet CSS and JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<!-- Leaflet Routing Machine CSS and JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

<script>
    // Initialize map
    var map = L.map('map').setView([0, 0], 13);

    // Add OpenStreetMap tiles
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> | Geocoding by Nominatim'
    }).addTo(map);

    // Initialize variables
    var marker, circle, polyline;
    var latlngs = [];
    var geocodeUrl = 'https://nominatim.openstreetmap.org/reverse?format=json';
    var busMarkers = {}; // Object to store bus markers by bus ID
    var busPolylines = {}; // Object to store bus polylines by bus ID
    var busSpeeds = {}; // Object to store bus speed and last position data
    var lastPosition = null;
    var lastTimestamp = null;

    if (!navigator.geolocation) {
        alert("Geolocation is not supported by your browser");
    } else {
        navigator.geolocation.watchPosition(
            async function(position) {
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;
                    var accuracy = position.coords.accuracy;
                    var currentTimestamp = position.timestamp;

                    // Calculate speed
                    var speed = 0;
                    if (lastPosition && lastTimestamp) {
                        var distance = calculateDistance(
                            lastPosition.lat,
                            lastPosition.lng,
                            lat,
                            lng
                        );
                        var timeElapsed = (currentTimestamp - lastTimestamp) / 1000;
                        speed = (distance / timeElapsed).toFixed(2);
                    }

                    lastPosition = {
                        lat,
                        lng
                    };
                    lastTimestamp = currentTimestamp;

                    document.getElementById('coordinates').textContent =
                        `${lat.toFixed(6)}, ${lng.toFixed(6)} (±${Math.round(accuracy)}m)`;
                    document.getElementById('speed').textContent = `${speed} m/s`;

                    if (!marker) {
                        map.setView([lat, lng], 13);
                        marker = L.marker([lat, lng]).addTo(map);
                        circle = L.circle([lat, lng], {
                            radius: accuracy
                        }).addTo(map);
                        polyline = L.polyline(latlngs, {
                            color: 'blue'
                        }).addTo(map);
                    } else {
                        marker.setLatLng([lat, lng]);
                        circle.setLatLng([lat, lng]).setRadius(accuracy);
                    }

                    latlngs.push([lat, lng]);
                    polyline.setLatLngs(latlngs);
                    map.fitBounds(polyline.getBounds());

                    try {
                        const response = await fetch(`${geocodeUrl}&lat=${lat}&lon=${lng}`);
                        const data = await response.json();
                        document.getElementById('address').textContent = data.display_name || 'Unknown location';
                    } catch (error) {
                        document.getElementById('address').textContent = 'Could not retrieve address';
                    }

                    // Clear existing bus markers
                    Object.values(busMarkers).forEach(function(busMarker) {
                        map.removeLayer(busMarker);
                    });
                    busMarkers = {};

                    // Add bus markers
                    @foreach ($buses as $bus)
                        var busDetails = `
                            <b>Bus Number:</b> {{ $bus->bus_number }}<br>
                            <b>Capacity:</b> {{ $bus->capacity }}<br>
                            <b>Route:</b> {{ $bus->route->name }}<br>
                            <b>Starting Station:</b> {{ $bus->route->startingStation->name }}<br>
                            <b>Ending Station:</b> {{ $bus->route->endingStation->name }}<br>
                            <b>Speed:</b> <span id="bus-speed-{{ $bus->id }}">0</span> m/s<br>
                        `;

                        // Initialize the bus marker at the starting station coordinates
                        var busMarker = L.marker([
                                {{ $bus->route->startingStation->latitude }},
                                {{ $bus->route->startingStation->longitude }}
                            ])
                            .addTo(map)
                            .bindPopup(busDetails);

                        // Add the marker to the busMarkers object
                        busMarkers[{{ $bus->id }}] = busMarker;

                        // Initialize a polyline for the bus route
                        var busPolyline = L.polyline([
                            [{{ $bus->route->startingStation->latitude }},
                                {{ $bus->route->startingStation->longitude }}
                            ]
                        ], {
                            color: 'red',
                            weight: 3
                        }).addTo(map);

                        // Add the polyline to the busPolylines object
                        busPolylines[{{ $bus->id }}] = busPolyline;

                        // Store the initial position in the busSpeeds object
                        busSpeeds[{{ $bus->id }}] = {
                            lat: {{ $bus->route->startingStation->latitude }},
                            lng: {{ $bus->route->startingStation->longitude }},
                            timestamp: Date.now()
                        };
                    @endforeach
                },
                function(error) {
                    if (error.code === error.PERMISSION_DENIED) {
                        alert("Location permission denied");
                    }
                }, {
                    enableHighAccuracy: true,
                    maximumAge: 0,
                    timeout: 5000
                }
        );
    }

    // Real-time clock
    function updateClock() {
        var now = new Date();
        document.getElementById('real-time-clock').textContent = now.toLocaleTimeString();
    }
    setInterval(updateClock, 1000);
    updateClock();

    // Dark mode toggle
    document.getElementById('toggle-dark-mode').addEventListener('change', function() {
        if (this.checked) {
            document.body.style.backgroundColor = '#333';
            document.body.style.color = '#fff';
        } else {
            document.body.style.backgroundColor = '#fff';
            document.body.style.color = '#000';
        }
    });

    var busesData = {
        @foreach ($buses as $bus)
            {{ $bus->id }}: {
                bus_number: '{{ $bus->bus_number }}',
                capacity: '{{ $bus->capacity }}',
                route_name: '{{ $bus->route->name }}',
                starting_station: '{{ $bus->route->startingStation->name }}',
                ending_station: '{{ $bus->route->endingStation->name }}',
                starting_station_lat: '{{ $bus->route->startingStation->latitude }}',
                starting_station_lng: '{{ $bus->route->startingStation->longitude }}',
                ending_station_lat: '{{ $bus->route->endingStation->latitude }}',
                ending_station_lng: '{{ $bus->route->endingStation->longitude }}'
            },
        @endforeach
    };

    document.getElementById('direction-buttons').addEventListener('click', function(event) {
        if (event.target.classList.contains('move-bus')) {
            var selectedBusId = document.getElementById('bus-select').value;
            if (!selectedBusId) {
                alert('Please select a bus first.');
                return;
            }

            var direction = event.target.getAttribute('data-direction');
            var busMarker = busMarkers[selectedBusId];
            var busPolyline = busPolylines[selectedBusId];

            if (busMarker && busPolyline) {
                var currentLatLng = busMarker.getLatLng();
                var newLat = currentLatLng.lat;
                var newLng = currentLatLng.lng;

                // Adjust coordinates based on direction
                switch (direction) {
                    case 'north':
                        newLat += (2 / 6371000) * (180 / Math.PI);
                        break;
                    case 'south':
                        newLat -= (2 / 6371000) * (180 / Math.PI);
                        break;
                    case 'east':
                        newLng += (2 / 6371000) * (180 / Math.PI) / Math.cos(currentLatLng.lat * Math.PI / 180);
                        break;
                    case 'west':
                        newLng -= (2 / 6371000) * (180 / Math.PI) / Math.cos(currentLatLng.lat * Math.PI / 180);
                        break;
                }

                animateBusMovement(busMarker, {
                    lat: newLat,
                    lng: newLng
                });

                var polylineLatLngs = busPolyline.getLatLngs();
                polylineLatLngs.push([newLat, newLng]);
                busPolyline.setLatLngs(polylineLatLngs);

                var previousData = busSpeeds[selectedBusId];
                var currentTime = Date.now();
                var timeElapsed = (currentTime - previousData.timestamp) / 1000;
                var distance = calculateDistance(previousData.lat, previousData.lng, newLat, newLng);
                var speed = (distance / timeElapsed).toFixed(2);

                // Update busSpeeds data
                busSpeeds[selectedBusId] = {
                    lat: newLat,
                    lng: newLng,
                    timestamp: currentTime
                };

                // Calculate distances
                var startingStation = {
                    lat: busesData[selectedBusId].starting_station_lat,
                    lng: busesData[selectedBusId].starting_station_lng
                };
                var endingStation = {
                    lat: busesData[selectedBusId].ending_station_lat,
                    lng: busesData[selectedBusId].ending_station_lng
                };

                var distanceMoved = calculateDistance(startingStation.lat, startingStation.lng, newLat, newLng)
                    .toFixed(2);
                var remainingDistance = calculateDistance(newLat, newLng, endingStation.lat, endingStation.lng)
                    .toFixed(2);
                var totalDistance = calculateDistance(startingStation.lat, startingStation.lng, endingStation
                    .lat, endingStation.lng).toFixed(2);

                // Calculate ETA
                var eta = speed > 0 ? (remainingDistance / speed).toFixed(2) : 'N/A';

                // Update the popup content with all details including total distance
                var busData = busesData[selectedBusId];
                var popupContent = `
                <b>Bus Number:</b> ${busData.bus_number}<br>
                <b>Capacity:</b> ${busData.capacity}<br>
                <b>Route:</b> ${busData.route_name}<br>
                <b>Starting Station:</b> ${busData.starting_station}<br>
                <b>Ending Station:</b> ${busData.ending_station}<br>
                <b>Speed:</b> ${speed} m/s<br>
                <b>Total Distance:</b> ${totalDistance} meters<br>
                <b>Distance Moved:</b> ${distanceMoved} meters<br>
                <b>Remaining Distance:</b> ${remainingDistance} meters<br>
                <b>ETA:</b> ${eta} seconds<br>
            `;
                busMarker.setPopupContent(popupContent);
            }
        }
    });

    // Jump to Destination functionality
    document.getElementById('jump-to-destination').addEventListener('click', function() {
        var selectedBusId = document.getElementById('bus-select').value;
        if (!selectedBusId) {
            alert('Please select a bus first.');
            return;
        }

        var busMarker = busMarkers[selectedBusId];
        var busPolyline = busPolylines[selectedBusId];
        var busData = busesData[selectedBusId];

        if (busMarker && busData) {
            // Move the marker to the destination
            var destinationLatLng = {
                lat: parseFloat(busData.ending_station_lat),
                lng: parseFloat(busData.ending_station_lng)
            };

            busMarker.setLatLng(destinationLatLng);

            // Update the polyline to include the destination
            var polylineLatLngs = busPolyline.getLatLngs();
            polylineLatLngs.push(destinationLatLng);
            busPolyline.setLatLngs(polylineLatLngs);

            // Update the popup content
            var popupContent = `
                <b>Bus Number:</b> ${busData.bus_number}<br>
                <b>Capacity:</b> ${busData.capacity}<br>
                <b>Route:</b> ${busData.route_name}<br>
                <b>Starting Station:</b> ${busData.starting_station}<br>
                <b>Ending Station:</b> ${busData.ending_station}<br>
                <b>Status:</b> Arrived at Destination<br>
            `;
            busMarker.setPopupContent(popupContent).openPopup();

            alert(`Bus ${busData.bus_number} has jumped to its destination.`);
        } else {
            alert('Bus data not found.');
        }
    });

    // Animate bus movement
    function animateBusMovement(busMarker, newLatLng) {
        var currentLatLng = busMarker.getLatLng();
        var duration = 1000; // 1 second
        var steps = 20; // Number of animation steps
        var stepLat = (newLatLng.lat - currentLatLng.lat) / steps;
        var stepLng = (newLatLng.lng - currentLatLng.lng) / steps;

        var step = 0;
        var interval = setInterval(function() {
            if (step >= steps) {
                clearInterval(interval);
            } else {
                currentLatLng.lat += stepLat;
                currentLatLng.lng += stepLng;
                busMarker.setLatLng(currentLatLng);
                step++;
            }
        }, duration / steps);
    }

    // Function to calculate distance between two coordinates (Haversine formula)
    function calculateDistance(lat1, lng1, lat2, lng2) {
        var R = 6371000;
        var dLat = (lat2 - lat1) * Math.PI / 180;
        var dLng = (lng2 - lng1) * Math.PI / 180;
        var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
            Math.sin(dLng / 2) * Math.sin(dLng / 2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return R * c;
    }

    // Add routing functionality
    function showRoute(startLat, startLng, endLat, endLng) {
        if (typeof L.Routing === 'undefined') {
            console.error('Leaflet Routing Machine is not loaded.');
            return;
        }

        L.Routing.control({
            waypoints: [
                L.latLng(startLat, startLng),
                L.latLng(endLat, endLng)
            ],
            routeWhileDragging: true
        }).addTo(map);
    }

    // Example usage: Show route for a selected bus
    document.getElementById('bus-select').addEventListener('change', function() {
        var selectedBusId = this.value;
        if (selectedBusId) {
            var busData = busesData[selectedBusId];
            showRoute(
                busData.starting_station_lat,
                busData.starting_station_lng,
                busData.ending_station_lat,
                busData.ending_station_lng
            );
        }
    });
</script>

<style>
    #location-info {
        background: rgba(255, 255, 255, 0.8);
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        font-size: 14px;
        line-height: 1.4;
    }

    #location-info p {
        margin: 5px 0;
    }

    #bus-controls select,
    #search-bus {
        margin: 5px 0;
        padding: 5px;
        width: 100%;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    #direction-buttons button {
        margin: 5px;
        padding: 10px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 50%;
        font-size: 16px;
        cursor: pointer;
        width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    #direction-buttons button:hover {
        background-color: #218838;
    }

    #map-legend {
        font-size: 14px;
    }
</style>
