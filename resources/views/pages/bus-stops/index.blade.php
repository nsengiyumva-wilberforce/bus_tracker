<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-light d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Bus Stops Management</h5>
                        <a href="{{ route('bus-stops.create') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-plus me-2"></i>Add New Bus Stop
                        </a>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="fw-bold">Stop Name</th>
                                        <th class="fw-bold">Location</th>
                                        <th class="fw-bold">Coordinates</th>
                                        <th class="fw-bold text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($busStops as $busStop)
                                        <tr>
                                            <td class="fw-semibold">{{ $busStop->name }}</td>
                                            <td>{{ $busStop->location }}</td>
                                            <td>
                                                @if ($busStop->latitude && $busStop->longitude)
                                                    <span class="badge bg-info">
                                                        <i class="fas fa-map-marker-alt me-2"></i>
                                                        {{ number_format($busStop->latitude, 6) }},
                                                        {{ number_format($busStop->longitude, 6) }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <div class="d-inline-flex gap-2">
                                                    <a href="{{ route('bus-stops.edit', $busStop->id) }}"
                                                        class="btn btn-sm btn-outline-primary" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form method="POST"
                                                        action="{{ route('bus-stops.destroy', $busStop->id) }}"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                            onclick="return confirm('Are you sure you want to delete this bus stop?')"
                                                            title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if ($busStops->hasPages())
                            <div class="mt-4">
                                {{ $busStops->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
