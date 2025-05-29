    <!-- Header -->
    <header>
        <div class="container header-container">
            <div class="logo">
                <a href="/">
                    <img src="{{ asset('images/logo1.png') }}" alt="BusPulse Logo">
                    <div class="logo-text">Bus<span>Pulse</span></div>
                </a>
            </div>

            <div class="mobile-toggle">
                <i class="fas fa-bars"></i>
            </div>

            <nav class="nav-menu">
                <a href="/">Home</a>

                <!-- Hidden logout form -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                <!-- Authentication State -->
                <div id="auth-state">
                    @auth
                        <a href="{{ route('booking') }}">Booking</a>
                        <a href="{{ route('tracking') }}">Tracking</a>
                        <a href="{{ route('stations') }}">Stations</a>
                        <a href="{{ route('routes') }}">Routes</a>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="btn">Logout</a>
                    @else
                        <a href="{{ route('login') }}" class="btn">Login</a>
                        <a href="{{ url('/register') }}" class="btn"
                            style="background-color: var(--primary); color: white;">Sign Up</a>
                    @endauth
                </div>
            </nav>
        </div>
    </header>
