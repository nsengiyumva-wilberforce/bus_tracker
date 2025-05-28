<nav>
        <div class="logo">
            <img src="{{asset('images/logo1.png')}}" alt="BusPulse Logo">
        </div>
        <ul>
            <li><a href="{{ route('dashboard') }}">Home</a></li>
            <li><a class="nav-link" href="{{ route('track-bus') }}">Track Bus</a></li>
            <li><a href="{{ route('my.bookings') }}">My Bookings</a></li>
            <li><a href="{{ route('contact')}}">Contact Us</a></li>
            <li>
                @if(Auth::check())
                <li class="nav-item">
                    <b><a class="nav-link" href="#" style="color: black;">Hello, {{ Auth::user()->name }}</a></b>
                </li>
                @endif

            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>

            </li>
            
        </ul>
    </nav>