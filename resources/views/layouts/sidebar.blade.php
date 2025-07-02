<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start  bg-white" style="min-width: 250px;"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand px-4 py-3 m-0" href="/dashboard">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
            {{-- <span class="ms-1 text-sm text-dark">Bus Pulse</span> --}}
        </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @if (auth()->user()->hasRole('admin'))
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard') ? 'active bg-primary text-white' : 'text-dark' }}"
                        href="/dashboard">
                        <i class="material-symbols-rounded opacity-5">dashboard</i>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('bus-stops') ? 'active bg-primary text-white' : 'text-dark' }}"
                        href="/bus-stops">
                        <i class="material-symbols-rounded opacity-5">table_view</i>
                        <span class="nav-link-text ms-1">Bus Stops</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('routes') ? 'active bg-primary text-white' : 'text-dark' }}"
                        href="/routes">
                        <i class="material-symbols-rounded opacity-5">table_view</i>
                        <span class="nav-link-text ms-1">Routes and Schedules</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('buses') ? 'active bg-primary text-white' : 'text-dark' }}"
                        href="/buses">
                        <i class="material-symbols-rounded opacity-5">table_view</i>
                        <span class="nav-link-text ms-1">Bus Management</span>
                    </a>
                </li>
            @endif

            <li class="nav-item">
                <a class="nav-link {{ Request::is('tracking') ? 'active bg-primary text-white' : 'text-dark' }}"
                    href="/tracking">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Live Tracking</span>
                </a>
            </li>
            @if (auth()->user()->hasRole('admin'))
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admins') ? 'active bg-primary text-white' : 'text-dark' }}"
                        href="/admins">
                        <i class="material-symbols-rounded opacity-5">table_view</i>
                        <span class="nav-link-text ms-1">Drivers & Staff</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('passengers') ? 'active bg-primary text-white' : 'text-dark' }}"
                        href="/passengers">
                        <i class="material-symbols-rounded opacity-5">table_view</i>
                        <span class="nav-link-text ms-1">Passenger Management</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('manage-bookings') ? 'active bg-primary text-white' : 'text-dark' }}"
                        href="/manage-bookings">
                        <i class="material-symbols-rounded opacity-5">table_view</i>
                        <span class="nav-link-text ms-1">Booking Management</span>
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link {{ Request::is('reports') ? 'active bg-primary text-white' : 'text-dark' }}"
                    href="/reports">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Reports & Analytics</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Settings</h6>
            </li>
            @if (auth()->user()->hasRole('admin'))
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('roles.index') }}">
                        <i class="material-symbols-rounded opacity-5">person</i>
                        <span class="nav-link-text ms-1">Roles</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('permissions.index') }}">
                        <i class="material-symbols-rounded opacity-5">person</i>
                        <span class="nav-link-text ms-1">Permissions</span>
                    </a>
                </li>
            @endif

            <li class="nav-item">
                <a class="nav-link text-dark" href="profile">
                    <i class="material-symbols-rounded opacity-5">person</i>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a class="nav-link text-dark" href="#"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="material-symbols-rounded opacity-5">logout</i>
                    <span class="nav-link-text ms-1">Logout</span>
                </a>
            </li>

        </ul>
    </div>
</aside>
