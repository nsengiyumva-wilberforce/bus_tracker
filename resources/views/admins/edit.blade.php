<x-app-layout>
    <div class="container-fluid py-2">
        <div class="card-header bg-primary text-light">Edit Admin User</div>
        <div class="card-body">
            <a href="{{ route('admins.index') }}" title="Back" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back
            </a>
            <br><br>
            
            <form method="POST" action="{{ route('admins.update', $admin->id) }}">
                @csrf
                @method('PUT')
                @include('admins.form')
            </form>
        </div>
    </div>
</x-app-layout>