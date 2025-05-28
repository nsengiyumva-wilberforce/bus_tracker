<x-app-layout>
    <div class="row">
        <div id="map" style="height: 80vh;"></div>
    </div>
</x-app-layout>

<script type="module">
    import { initMap, updateBusLocation } from './bus-map.js';
    
    // Initialize map with default position
    initMap({{ $defaultLatitude ?? 0 }}, {{ $defaultLongitude ?? 0 }});
    
    // Listen for real-time updates
    window.Echo.channel('bus-locations')
        .listen('BusLocationUpdated', (e) => {
            updateBusLocation(e);
        });
</script>