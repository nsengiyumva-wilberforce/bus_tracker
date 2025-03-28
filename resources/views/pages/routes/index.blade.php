<x-app-layout>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-light d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Route Management</h5>
                        <a href="{{ route('routes.create') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-plus me-2"></i>Add New Route
                        </a>
                    </div>
                    
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="fw-bold">Route Name</th>
                                        <th class="fw-bold">Starting Station</th>
                                        <th class="fw-bold">Ending Station</th>
                                        <th class="fw-bold">Timetable</th>
                                        <th class="fw-bold text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($routes as $route)
                                        <tr>
                                            <td class="fw-semibold">{{ $route->name }}</td>
                                            <td>{{ $route->startingStation->name ?? 'N/A' }}</td>
                                            <td>{{ $route->endingStation->name ?? 'N/A' }}</td>
                                            <td>
                                                @foreach ( json_decode($route->timetable) as $time)
                                                    
                                                
                                                <span class="badge bg-info">
                                                    {{ $time }}
                                                </span>

                                                @endforeach
                                            </td>
                                            <td class="text-end">
                                                <div class="d-inline-flex gap-2">
                                                    <a href="{{ route('routes.edit', $route->id) }}" 
                                                       class="btn btn-sm btn-outline-primary"
                                                       title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form method="POST" 
                                                          action="{{ route('routes.destroy', $route->id) }}"
                                                          class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-sm btn-outline-danger"
                                                                onclick="return confirm('Are you sure you want to delete this route?')"
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

                        @if($routes->hasPages())
                            <div class="mt-4">
                                {{ $routes->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>