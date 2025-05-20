<!-- resources/views/bus_stops/form.blade.php -->
<div class="card shadow-lg mb-4">
    <div class="card-header bg-primary text-white py-3">
        <h5 class="mb-0"><i class="fas fa-bus me-2"></i>Basic Information</h5>
    </div>
    <div class="card-body">
        <!-- Bus Stop Name Field -->
        <div class="form-group mb-4">
            <label for="name" class="form-label fw-bold text-dark">
                <i class="fas fa-signature me-2 text-muted"></i>Bus Stop Name
                <span class="text-danger">*</span>
            </label>
            <input class="form-control form-control-lg border-2 border-primary @error('name') is-invalid @enderror"
                name="name" type="text" id="name" placeholder="e.g. Central Bus Terminal"
                value="{{ old('name', $busStop->name ?? '') }}">
            @error('name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Location Address Field -->
        <div class="form-group mb-4">
            <label for="location" class="form-label fw-bold text-dark">
                <i class="fas fa-map-pin me-2 text-muted"></i>Physical Address
                <span class="text-danger">*</span>
            </label>
            <div class="input-group">
                <span class="input-group-text bg-primary text-white">
                    <i class="fas fa-search-location"></i>
                </span>
                <input class="form-control form-control-lg border-primary @error('location') is-invalid @enderror"
                    name="location" type="text" id="location" readonly
                    placeholder="Address will be auto-filled from map selection"
                    value="{{ old('location', $busStop->location ?? '') }}">
                @error('location')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
            <small class="form-text text-muted mt-1">
                Geo-coded location (click map or search to update)
            </small>
        </div>
    </div>
</div>

<div class="card shadow-lg mb-4">
    <div class="card-header bg-primary text-white py-3">
        <h5 class="mb-0"><i class="fas fa-map-marked-alt me-2"></i>Geolocation Details</h5>
    </div>
    <div class="card-body">
        <!-- Interactive Map -->
        <div class="form-group mb-4">
            <div class="alert alert-info d-flex align-items-center" role="alert">
                <i class="fas fa-info-circle me-2"></i>
                Click on the map or search address to set precise location
            </div>
            <div id="map" style="height: 350px; border-radius: 8px;" class="border-2 border-primary shadow-sm">
            </div>
        </div>

        <!-- Coordinates Section -->
        <div class="row g-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="latitude" class="form-label fw-bold text-dark">
                        <i class="fas fa-arrows-alt-v me-2 text-muted"></i>Latitude
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white">
                            <i class="fas fa-globe-americas"></i>
                        </span>
                        <input
                            class="form-control form-control-lg border-primary @error('latitude') is-invalid @enderror"
                            name="latitude" type="number" step="0.000001" id="latitude" placeholder="40.712776"
                            value="{{ old('latitude', $busStop->latitude ?? '') }}" min="-90" max="90">
                        <span class="input-group-text bg-light">°N</span>
                        @error('latitude')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <small class="form-text text-muted mt-1">
                        Decimal format (-90.000000 to 90.000000)
                    </small>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="longitude" class="form-label fw-bold text-dark">
                        <i class="fas fa-arrows-alt-h me-2 text-muted"></i>Longitude
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white">
                            <i class="fas fa-globe"></i>
                        </span>
                        <input
                            class="form-control form-control-lg border-primary @error('longitude') is-invalid @enderror"
                            name="longitude" type="number" step="0.000001" id="longitude" placeholder="-74.005974"
                            value="{{ old('longitude', $busStop->longitude ?? '') }}" min="-180" max="180">
                        <span class="input-group-text bg-light">°E</span>
                        @error('longitude')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <small class="form-text text-muted mt-1">
                        Decimal format (-180.000000 to 180.000000)
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Submit Button -->
<div class="d-grid gap-2 mt-4">
    <button type="submit" class="btn btn-primary btn-lg py-3 fw-bold shadow-sm">
        <i class="fas fa-save me-2"></i>
        {{ isset($busStop) ? 'Update Bus Stop' : 'Create New Bus Stop' }}
    </button>
</div>

<style>
    .form-label {
        font-size: 1.1rem;
    }

    .input-group-text {
        transition: all 0.3s ease;
    }

    .invalid-feedback {
        font-size: 0.9rem;
    }

    #map {
        transition: transform 0.3s ease;
    }

    #map:hover {
        transform: scale(1.005);
    }
</style>

@push('scripts')
    <!-- Leaflet Resources -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var geocodeUrl = 'https://nominatim.openstreetmap.org/reverse?format=json';
            // Initialize map
            const map = L.map('map');
            const marker = L.marker([0, 0], {
                draggable: true,
                autoPan: true
            }).addTo(map);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

            // Initialize geocoder with proper configuration
            const geocoder = L.Control.Geocoder.nominatim({
                geocodingQueryParams: {
                    'accept-language': 'en',
                    'countrycodes': '',
                    'format': 'json',
                    'addressdetails': 1
                }
            });

            const geocoderControl = L.Control.geocoder({
                geocoder: geocoder,
                position: 'topright',
                placeholder: 'Search address…',
                errorMessage: 'Location not found.',
                defaultMarkGeocode: false,
                showResultIcons: true
            }).addTo(map);

            // Coordinate update function
            const updateCoordinates = (latlng) => {
                document.getElementById('latitude').value = latlng.lat.toFixed(6);
                document.getElementById('longitude').value = latlng.lng.toFixed(6);
            };

            // Fixed address update function with proper error handling
            const updateAddress = async (latlng) => {
                console.log("Reverse geocoding for:", latlng);
                const response = await fetch(`${geocodeUrl}&lat=${latlng.lat}&lon=${latlng.lng}`);
                const data = await response.json();
                document.getElementById('location').value = data.display_name || 'Unknown location';
            };

            // Map click handler
            map.on('click', (e) => {
                console.log("Map click at:", e.latlng);
                marker.setLatLng(e.latlng);
                updateCoordinates(e.latlng);
                updateAddress(e.latlng);
                map.panTo(e.latlng);
            });

            // Marker drag handler
            marker.on('dragend', (e) => {
                const position = marker.getLatLng();
                console.log("Marker dragged to:", position);
                updateCoordinates(position);
                updateAddress(position);
            });

            // Initialization code
            @if (isset($busStop) && $busStop->latitude && $busStop->longitude)
                const initialCoords = L.latLng({{ $busStop->latitude }}, {{ $busStop->longitude }});
                console.log("Initializing with existing coordinates:", initialCoords);
                map.setView(initialCoords, 16);
                marker.setLatLng(initialCoords);
                updateAddress(initialCoords);
            @else
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        (pos) => {
                            const userCoords = L.latLng(pos.coords.latitude, pos.coords.longitude);
                            console.log("Using geolocation coordinates:", userCoords);
                            map.setView(userCoords, 14);
                            marker.setLatLng(userCoords);
                            updateCoordinates(userCoords);
                            updateAddress(userCoords);
                        },
                        (error) => {
                            console.warn("Geolocation error:", error);
                            const defaultCoords = L.latLng(51.505, -0.09);
                            console.log("Using default coordinates:", defaultCoords);
                            map.setView(defaultCoords, 13);
                            marker.setLatLng(defaultCoords);
                            updateCoordinates(defaultCoords);
                            updateAddress(defaultCoords);
                        }
                    );
                }
            @endif

            // Search result handler
            geocoderControl.on('markgeocode', (e) => {
                console.log("Search result:", e.geocode);
                const {
                    center,
                    name,
                    properties
                } = e.geocode;
                marker.setLatLng(center);
                updateCoordinates(center);

                const address = properties?.address ?
                    Object.values(properties.address).filter(Boolean).join(', ') :
                    name;

                document.getElementById('location').value = address;
                map.setView(center, 16);
            });
        });
    </script>
@endpush
