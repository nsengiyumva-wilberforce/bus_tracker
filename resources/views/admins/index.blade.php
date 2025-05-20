<x-app-layout>
    <div class="container-fluid py-2">
        <div class="card-body">
            <a href="{{ route('admins.create') }}" class="btn btn-success mb-3">
                <i class="fa fa-plus"></i> Create New Admin
            </a>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $admin)
                    <tr>
                        <td>{{ $admin->user->first_name.' '.$admin->user->last_name }}</td>
                        <td>{{ $admin->role }}</td>
                        <td>
                            <a href="{{ route('admins.show', $admin->id) }}" class="btn btn-info btn-sm">
                                <i class="fa fa-eye"></i> View
                            </a>
                            <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            {{ $admins->links() }}
        </div>
    </div>
</x-app-layout>