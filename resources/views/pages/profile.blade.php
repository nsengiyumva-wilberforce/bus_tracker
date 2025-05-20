<x-app-layout>
    <div class="container-fluid px-2 px-md-4">
        <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
            <span class="mask bg-gradient-dark opacity-6"></span>
        </div>
        <div class="card card-body mx-2 mx-md-2 mt-n6">
            <div class="row gx-4 mb-2">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="{{ $user->profile_picture_url }}" alt="profile" class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">{{ $user->first_name }} {{ $user->last_name }}</h5>
                        <p class="mb-0 font-weight-normal text-sm">{{ $user->username }}</p>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12 col-xl-4">
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Profile Information</h6>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group">
                                <li class="list-group-item border-0 ps-0 pt-0 text-sm">
                                    <strong>Username:</strong> {{ $user->username }}
                                </li>
                                <li class="list-group-item border-0 ps-0 text-sm">
                                    <strong>Email:</strong> {{ $user->email }}
                                </li>
                                <li class="list-group-item border-0 ps-0 text-sm">
                                    <strong>Phone:</strong> {{ $user->phone_number ?? 'N/A' }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-4">
                    <div class="card card-plain h-100">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Preferences</h6>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group">
                                @foreach($user->preferences ?? [] as $preference => $value)
                                <li class="list-group-item border-0 px-0">
                                    <div class="form-check form-switch ps-0">
                                        <input class="form-check-input ms-auto" type="checkbox" 
                                            {{ $value ? 'checked' : '' }} disabled>
                                        <label class="form-check-label text-body ms-3">
                                            {{ ucfirst(str_replace('_', ' ', $preference)) }}
                                        </label>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>