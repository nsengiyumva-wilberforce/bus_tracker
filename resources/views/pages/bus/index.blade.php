<x-app-layout>
    <div class="mt-3" id="departments">
        <h5 class="text-center mt-5">Buses</h5>
        <div class="mt-3">
            <a href="{{ route('buses.create') }}" class="btn btn-primary">Add Bus</a>
        </div>

        <div class="mt-3">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Bus No.</th>
                        <th>Capacity</th>
                        <th>Route</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($buses as $bus)
                        <tr>
                            <td>{{ $bus->bus_number }}</td>
                            <td>{{ $bus->capacity }}</td>
                            <td>{{ $bus->route->name }}</td>
                            <td>
                                <a href="{{ route('buses.edit', $bus->id) }}" class="btn btn-primary">Edit</a>
                                <form method="POST" action="{{ route('buses.destroy', $bus->id) }}"
                                    accept-charset="UTF-8" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm(&quot;Are you sure?&quot;)">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</x-app-layout>
