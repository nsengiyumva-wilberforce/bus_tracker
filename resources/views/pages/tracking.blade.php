<x-app-layout>
    <div id="map" style="height: 100vh;"></div>
    <div id="location-info" class="leaflet-control leaflet-bar" style="padding: 10px; background: white;">
        <p>Coordinates: <span id="coordinates"></span></p>
        <p>Address: <span id="address">Loading...</span></p>
    </div>
</x-app-layout>

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

    // Location info control
    var infoControl = L.control({
        position: 'bottomleft'
    });
    infoControl.onAdd = function(map) {
        return L.DomUtil.get('location-info');
    };
    infoControl.addTo(map);

    if (!navigator.geolocation) {
        alert("Geolocation is not supported by your browser");
    } else {
        navigator.geolocation.watchPosition(
            async function(position) {
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;
                    var accuracy = position.coords.accuracy;

                    // Update coordinates display
                    document.getElementById('coordinates').textContent =
                        `${lat.toFixed(6)}, ${lng.toFixed(6)} (±${Math.round(accuracy)}m)`;

                    // Update map elements
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

                    // Update polyline
                    latlngs.push([lat, lng]);
                    polyline.setLatLngs(latlngs);
                    map.fitBounds(polyline.getBounds());

                    // Reverse geocoding
                    try {
                        const response = await fetch(`${geocodeUrl}&lat=${lat}&lon=${lng}`);
                        const data = await response.json();
                        document.getElementById('address').textContent = data.display_name || 'Unknown location';
                    } catch (error) {
                        document.getElementById('address').textContent = 'Could not retrieve address';
                    }
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
</style>
