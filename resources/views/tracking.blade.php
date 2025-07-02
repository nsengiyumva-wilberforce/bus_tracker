<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Your Trip - BusPulse</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0066cc;
            --primary-dark: #004d99;
            --secondary: #00cc99;
            --secondary-dark: #00aa77;
            --accent: #ff6b6b;
            --light: #f8f9fa;
            --dark: #333;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
            --border-radius: 12px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
            color: var(--dark);
            line-height: 1.6;
            overflow-x: hidden;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Styles */
        header {
            background-color: white;
            box-shadow: var(--shadow);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            padding: 15px 0;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo img {
            height: 40px;
        }

        .logo-text {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary);
        }

        .logo-text span {
            color: var(--secondary);
        }

        .nav-menu {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .nav-menu a {
            text-decoration: none;
            color: var(--dark);
            font-weight: 500;
            padding: 8px 15px;
            border-radius: 30px;
            transition: var(--transition);
            font-size: 0.95rem;
        }

        .nav-menu a:hover {
            background-color: var(--primary);
            color: white;
        }

        .nav-menu .btn {
            background-color: var(--primary);
            color: white;
            padding: 10px 20px;
        }

        .nav-menu .btn:hover {
            background-color: var(--primary-dark);
        }

        .mobile-toggle {
            display: none;
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* Main Content */
        .main-content {
            padding-top: 100px;
            padding-bottom: 60px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .page-title {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 15px;
        }

        .page-subtitle {
            color: var(--gray);
            max-width: 700px;
            margin: 0 auto;
            font-size: 1.2rem;
        }

        /* Booking Container */
        .booking-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 40px;
        }

        @media (min-width: 992px) {
            .booking-container {
                grid-template-columns: 1fr 1fr;
            }
        }

        /* Booking Form */
        .booking-form {
            background: white;
            border-radius: var(--border-radius);
            padding: 40px 30px;
            box-shadow: var(--shadow);
        }

        .form-title {
            font-size: 1.8rem;
            color: var(--primary);
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--light-gray);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
            background-color: white;
        }

        .form-control:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .form-submit {
            display: block;
            width: 100%;
            padding: 15px;
            background-color: var(--secondary);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            margin-top: 20px;
        }

        .form-submit:hover {
            background-color: var(--secondary-dark);
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 204, 153, 0.3);
        }

        /* Booking Summary */
        .booking-summary {
            background: white;
            border-radius: var(--border-radius);
            padding: 30px;
            box-shadow: var(--shadow);
            align-self: start;
            position: sticky;
            top: 120px;
        }

        .summary-title {
            font-size: 1.5rem;
            color: var(--primary);
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--light-gray);
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px dashed var(--light-gray);
        }

        .summary-label {
            color: var(--gray);
        }

        .summary-value {
            font-weight: 500;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 2px solid var(--light-gray);
            font-size: 1.2rem;
            font-weight: 600;
        }

        .summary-price {
            color: var(--secondary);
            font-size: 1.4rem;
        }

        /* Bus Preview */
        .bus-preview {
            background: white;
            border-radius: var(--border-radius);
            padding: 30px;
            box-shadow: var(--shadow);
            margin-top: 40px;
        }

        .bus-title {
            font-size: 1.5rem;
            color: var(--primary);
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--light-gray);
        }

        .bus-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .bus-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 20px;
        }

        .bus-detail {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .bus-detail i {
            color: var(--primary);
            font-size: 1.2rem;
        }

        /* Seat Selection */
        .seat-selection {
            background: white;
            border-radius: var(--border-radius);
            padding: 30px;
            box-shadow: var(--shadow);
            margin-top: 40px;
        }

        .seat-title {
            font-size: 1.5rem;
            color: var(--primary);
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--light-gray);
        }

        .bus-layout {
            background: #f0f8ff;
            border-radius: 10px;
            padding: 30px;
            position: relative;
        }

        .bus-driver {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--dark);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .seats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-top: 60px;
        }

        .seat {
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e1ecf7;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
            position: relative;
        }

        .seat:before {
            content: "";
            position: absolute;
            top: 5px;
            left: 5px;
            right: 5px;
            bottom: 5px;
            border: 2px dashed #b3d1f0;
            border-radius: 5px;
        }

        .seat:hover {
            background: #c0dbf5;
            transform: translateY(-3px);
        }

        .seat.selected {
            background: var(--secondary);
            color: white;
        }

        .seat.selected:before {
            border-color: rgba(255, 255, 255, 0.3);
        }

        .seat.occupied {
            background: #f8d7da;
            cursor: not-allowed;
            color: #721c24;
        }

        .seat.occupied:before {
            border-color: #f5c6cb;
        }

        .seat-legend {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 4px;
        }

        .available-color {
            background: #e1ecf7;
        }

        .selected-color {
            background: var(--secondary);
        }

        .occupied-color {
            background: #f8d7da;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .page-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 768px) {
            .mobile-toggle {
                display: block;
            }

            .nav-menu {
                position: fixed;
                top: 80px;
                right: -100%;
                flex-direction: column;
                background-color: white;
                width: 300px;
                height: calc(100vh - 80px);
                padding: 40px 20px;
                transition: var(--transition);
                box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
                z-index: 999;
            }

            .nav-menu.active {
                right: 0;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .bus-details {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .page-title {
                font-size: 1.8rem;
            }

            .seats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Animation Effects */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate {
            animation: fadeIn 0.8s ease forwards;
        }
    </style>
</head>

<body>
    @include('header')

    <main class="main-content">
        <div class="container">
            <div class="page-header animate">
                Live Location of your booked bus
            </div>

            <div class="row">
                <div id="map" style="height: 80vh;"></div>
            </div>


        </div>
    </main>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

    <script>
        var map = L.map('map').setView([0, 0], 13); // Default view, will be adjusted later
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        var busMarkers = {}; // Stores Leaflet markers for each bus
        var busRouteData = {}; // Stores route details (coordinates, distances, instructions) for each bus

        // Variable to hold the ID of the first bus, so we can focus on it
        let firstBusId = null;

        // Request notification permissions
        if ("Notification" in window && Notification.permission !== "granted") {
            Notification.requestPermission();
        }

        // Initialize bus markers and their routes from the server-side passed data
        @foreach ($buses as $bus)
            (function() {
                const busId = {{ $bus->id }};
                if (firstBusId === null) {
                    firstBusId = busId; // Set the first bus ID
                }
                const startLat = {{ $bus->route->startingStation->latitude }};
                const startLng = {{ $bus->route->startingStation->longitude }};
                const endLat = {{ $bus->route->endingStation->latitude }};
                const endLng = {{ $bus->route->endingStation->longitude }};
                const destinationLat = {{ $bus->route->endingStation->latitude }};
                const destinationLng = {{ $bus->route->endingStation->longitude }};


                // Create a bus marker at the starting position initially
                const busMarker = L.marker([startLat, startLng], {
                    icon: L.divIcon({
                        className: 'bus-marker',
                        html: '<div class="bus-icon">🚌</div>',
                        iconSize: [30, 30]
                    })
                }).addTo(map).bindPopup(`<h5>Bus ${busId} Loading Location...</h5>`);

                busMarkers[busId] = busMarker; // Store the marker for later updates

                // Initialize route data structure for this bus
                busRouteData[busId] = {
                    routeControl: null, // Will store the L.Routing.control instance
                    coordinates: [],
                    cumulativeDistances: [],
                    totalDistance: 0,
                    instructions: [],
                    destinationReached: false, // Flag to prevent repeated notifications
                    destinationLatLng: L.latLng(destinationLat, destinationLng) // Store destination LatLng
                };

                // Add the route to the map
                const routeControl = L.Routing.control({
                    waypoints: [L.latLng(startLat, startLng), L.latLng(endLat, endLng)],
                    show: false, // Don't show directions panel
                    addWaypoints: false,
                    draggableWaypoints: false,
                    lineOptions: {
                        styles: [{
                            color: '#3388ff',
                            opacity: 0.7,
                            weight: 5
                        }]
                    }
                }).addTo(map);

                busRouteData[busId].routeControl = routeControl; // Store the control instance

                // Listen for when the route is found
                routeControl.on('routesfound', function(e) {
                    const route = e.routes[0];
                    busRouteData[busId].coordinates = route.coordinates;
                    busRouteData[busId].totalDistance = route.summary.totalDistance;
                    busRouteData[busId].instructions = route.instructions;

                    // Calculate cumulative distances for ETA calculation
                    const cumulativeDistances = [0];
                    for (let i = 1; i < route.coordinates.length; i++) {
                        cumulativeDistances.push(cumulativeDistances[i - 1] +
                            L.latLng(route.coordinates[i - 1]).distanceTo(L.latLng(route.coordinates[i])));
                    }
                    busRouteData[busId].cumulativeDistances = cumulativeDistances;

                    // Adjust map view to fit all routes if this is the first route found or a central point
                    // For multiple buses, you might want to set a single default view or fit all bounds.
                    // For simplicity, let's fit the first route found.
                    if (busId === firstBusId) { // Only fit bounds for the first bus
                        map.fitBounds(routeControl.getWaypoints().map(wp => wp.latLng));
                    }
                });

                // Update popup content when it's opened
                busMarker.on('popupopen', () => {
                    // The actual location data will come from the API, so we'll update the popup there.
                    // For now, this ensures a loading message if API hasn't updated yet.
                    busMarker.getPopup().setContent(`<h5>Bus ${busId} Waiting for live data...</h5>`).update();
                });

            })();
        @endforeach

        // Function to calculate ETA (simplified for real-time data)
        function calculateETA(busId, currentLat, currentLng) {
            const routeInfo = busRouteData[busId];
            if (!routeInfo || routeInfo.coordinates.length === 0) {
                return 'Calculating...'; // Route data not loaded yet
            }

            const currentLatLng = L.latLng(currentLat, currentLng);

            // Find the closest point on the route to the current bus position
            let closestPointIndex = 0;
            let minDistance = Infinity;

            for (let i = 0; i < routeInfo.coordinates.length; i++) {
                const routeCoord = L.latLng(routeInfo.coordinates[i]);
                const distance = currentLatLng.distanceTo(routeCoord);
                if (distance < minDistance) {
                    minDistance = distance;
                    closestPointIndex = i;
                }
            }

            // Calculate remaining distance from the closest point to the end of the route
            const remainingDistance = routeInfo.totalDistance - (routeInfo.cumulativeDistances[closestPointIndex] || 0);

            // This is a simple estimation. For more accurate ETA:
            // 1. You'd ideally get current speed from the RealTimeLocation data.
            // 2. You might factor in historical traffic data for remaining segments.
            // For demonstration, let's assume an average speed (e.g., 20 km/h = 5.56 m/s)
            const averageSpeedMps = 5.56; // meters per second (approx 20 km/h)
            if (averageSpeedMps === 0) return 'N/A'; // Avoid division by zero

            const estimatedRemainingTimeSeconds = remainingDistance / averageSpeedMps;

            // Convert seconds to a human-readable format
            const hours = Math.floor(estimatedRemainingTimeSeconds / 3600);
            const minutes = Math.floor((estimatedRemainingTimeSeconds % 3600) / 60);

            let etaString = '';
            if (hours > 0) {
                etaString += `${hours} hr `;
            }
            if (minutes > 0) {
                etaString += `${minutes} min`;
            }
            if (etaString === '' && estimatedRemainingTimeSeconds > 0) {
                etaString = 'Less than a minute';
            } else if (estimatedRemainingTimeSeconds <= 0) {
                etaString = 'Arrived!';
            }


            return etaString.trim();
        }

        // Function to find the current instruction index
        function getCurrentInstructionIndex(currentLatLng, routeInstructions, routeCoordinates) {
            if (!routeInstructions || routeInstructions.length === 0 || !routeCoordinates || routeCoordinates.length === 0)
                return -1;

            let closestInstructionIndex = 0;
            let minDistance = Infinity;

            // Iterate through instructions and find the one whose associated coordinate index
            // is closest to the bus's current position.
            routeInstructions.forEach((instr, index) => {
                if (instr.index < routeCoordinates.length) { // Ensure index is valid
                    const instructionCoord = L.latLng(routeCoordinates[instr.index]);
                    const distance = currentLatLng.distanceTo(instructionCoord);
                    if (distance < minDistance) {
                        minDistance = distance;
                        closestInstructionIndex = index;
                    }
                }
            });
            return closestInstructionIndex;
        }


        // Function to fetch and update bus locations from the API
        function fetchBusLocations() {
            fetch('/api/real_time_locations') // Your API endpoint
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    data.forEach(location => {
                        const busId = location.bus_id;
                        const newLat = parseFloat(location.latitude);
                        const newLng = parseFloat(location.longitude);
                        const speed = location.speed;
                        const direction = location.direction;
                        const timestamp = new Date(location.timestamp);

                        if (busMarkers[busId]) {
                            const currentLatLng = L.latLng(newLat, newLng);

                            // Update marker position
                            busMarkers[busId].setLatLng(currentLatLng);

                            // Only pan the map if this is the designated "focused" bus
                            // AND the bus is outside the current map bounds.
                            if (busId === firstBusId && !map.getBounds().contains(currentLatLng)) {
                                map.panTo(currentLatLng); // Smoothly pan to the new center
                            }

                            const eta = calculateETA(busId, newLat, newLng);

                            let popupContent = `
                                <h5>Bus ${busId} Status</h5>
                                <div class="metrics">
                                    <div>Last Updated: ${timestamp.toLocaleTimeString()}</div>
                                    <div>Speed: ${speed ? speed.toFixed(1) + ' km/h' : 'N/A'}</div>
                                    <div>Location: ${newLat.toFixed(6)}, ${newLng.toFixed(6)}</div>
                                    <div>Direction: ${direction ? direction + '°' : 'N/A'}</div>
                                    <div>ETA: ${eta}</div>
                                </div>
                            `;

                            const routeInfo = busRouteData[busId];
                            // if (routeInfo && routeInfo.instructions.length > 0) {
                            //     // popupContent += `<hr><h5>Directions</h5><div class="directions-list">`;
                            //     const currentInstrIndex = getCurrentInstructionIndex(currentLatLng, routeInfo
                            //         .instructions, routeInfo.coordinates);
                            //     routeInfo.instructions.forEach((instruction, index) => {
                            //         popupContent += `<div class="direction-step ${index === currentInstrIndex ? 'current-step' : ''}">
                            //             ${instruction.text}
                            //         </div>`;
                            //     });
                            //     popupContent += '</div>';
                            // }

                            // Update popup content (only if open, or always)
                            if (busMarkers[busId].isPopupOpen()) {
                                busMarkers[busId].getPopup().setContent(popupContent).update();
                            } else {
                                busMarkers[busId].getPopup().setContent(popupContent);
                            }


                            // Check for arrival notification (keep this logic)
                            const destinationLatLng = busRouteData[busId].destinationLatLng;
                            if (destinationLatLng) {
                                const distanceToDestination = currentLatLng.distanceTo(destinationLatLng);
                                if (distanceToDestination < 200 && !busRouteData[busId].destinationReached) {
                                    showBusArrivalNotification(busId);
                                    busRouteData[busId].destinationReached = true;
                                } else if (distanceToDestination >= 200 && busRouteData[busId].destinationReached) {
                                    busRouteData[busId].destinationReached = false;
                                }
                            }

                        } else {
                            console.warn(
                                `Marker for bus ${busId} not found. This bus might not be loaded initially.`
                            );
                        }
                    });
                })
                .catch(error => {
                    console.error('Error fetching bus locations:', error);
                    Object.values(busMarkers).forEach(marker => {
                        if (marker.isPopupOpen()) {
                            marker.getPopup().setContent(
                                `<h5>Connection Error</h5><div>Could not fetch live data.</div>`
                            ).update();
                        }
                    });
                });
        }

        // Keep your interval and initial call
        setInterval(fetchBusLocations, 5000);
        fetchBusLocations();

        function showBusArrivalNotification(busId) {
            if ("Notification" in window && Notification.permission === "granted") {
                new Notification(`Bus ${busId} has reached its destination!`, {
                    body: `Bus ${busId} has arrived at its final stop.`,
                    icon: '/images/bus_icon.png' // Optional: path to an icon for the notification
                });
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

</body>

</html>