<footer>
        <p>&copy; 2025 BusPulse. All Rights Reserved.</p> 
        <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
        </form>
</footer>