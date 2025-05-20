<x-app-layout>
    <div class="container-fluid py-2">
        <div class="card-header bg-primary text-light">Admin Details</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>User Information</h5>
                    <p><strong>Name:</strong> {{ $admin->user->first_name }} {{ $admin->user->last_name }}</p>
                    <p><strong>Email:</strong> {{ $admin->user->email }}</p>
                    <p><strong>Username:</strong> {{ $admin->user->username }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Admin Details</h5>
                    <p><strong>Role:</strong> {{ $admin->role }}</p>
                    <p><strong>Created At:</strong> {{ $admin->created_at->format('M d, Y H:i') }}</p>
                    <p><strong>Last Updated:</strong> {{ $admin->updated_at->format('M d, Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>