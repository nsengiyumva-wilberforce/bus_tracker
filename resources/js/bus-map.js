// Bus markers storage
const busMarkers = {};

// Initialize map
export function initMap(defaultLat, defaultLng) {
    window.map = L.map('map').setView([defaultLat, defaultLng], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(window.map);
}

// Create bus icon
function createBusIcon(busId) {
    return L.divIcon({
        className: 'bus-marker',
        html: `<div class="bus-icon">🚌 #${busId}</div>`,
        iconSize: [40, 40]
    });
}

// Update popup content
function updatePopupContent(location) {
    return `
        <h5>Bus #${location.bus_id}</h5>
        <div><strong>Status:</strong> ${location.speed > 0 ? 'Moving' : 'Stopped'}</div>
        <div><strong>Speed:</strong> ${location.speed || 0} km/h</div>
        <div><strong>Direction:</strong> ${location.direction || 'N/A'}</div>
        <div><strong>Last Update:</strong> ${new Date(location.timestamp).toLocaleTimeString()}</div>
        <div><small>Lat: ${location.latitude.toFixed(6)}, Lng: ${location.longitude.toFixed(6)}</small></div>
    `;
}

// Update bus location
export function updateBusLocation(location) {
    const busId = location.bus_id;
    const latLng = [location.latitude, location.longitude];
    
    if (!busMarkers[busId]) {
        // Create new marker
        busMarkers[busId] = L.marker(latLng, {
            icon: createBusIcon(busId)
        }).addTo(window.map);
        
        // Add popup
        busMarkers[busId].bindPopup(updatePopupContent(location));
    } else {
        // Update existing marker
        busMarkers[busId].setLatLng(latLng);
        
        // Update popup content
        busMarkers[busId].setPopupContent(updatePopupContent(location));
    }
    
    // Auto-open popup for moving buses
    if (location.speed > 0 && !busMarkers[busId].isPopupOpen()) {
        busMarkers[busId].openPopup();
    }
}