<div class="form-group mb-4">
    <label for="bus_number" class="block text-lg font-semibold mb-2">{{ 'Bus Number' }}</label>
    <input
        class="form-control w-full p-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
        name="bus_number" type="text" id="bus_number" value="{{ isset($bus->bus_number) ? $bus->bus_number : '' }}"
        placeholder="Enter Bus Number" required>
</div>

<div class="form-group mb-4">
    <label for="capacity" class="block text-lg font-semibold mb-2">{{ 'Capacity' }}</label>
    <input
        class="form-control w-full p-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
        name="capacity" type="number" id="capacity" value="{{ isset($bus->capacity) ? $bus->capacity : '' }}"
        placeholder="Enter Bus Capacity" required>
</div>

<div class="form-group mb-4">
    <label for="route_id" class="block text-lg font-semibold mb-2">{{ 'Route' }}</label>
    <select
        class="form-control w-full p-3 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
        name="route_id" id="route_id" required>
        <option value="" disabled selected>Select a Route</option>
        @foreach ($routes as $route)
            <option value="{{ $route->id }}" {{ isset($member) && $bus->route_id == $route->id ? 'selected' : '' }}>
                {{ $route->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group text-center">
    <input
        class="btn btn-primary"
        type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
