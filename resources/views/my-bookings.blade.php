<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings - BusPulse</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0066cc;
            --primary-dark: #004d99;
            --secondary: #00cc99;
            --secondary-dark: #00aa77;
            --accent: #ff6b6b;
            --error: #e53e3e;
            --light: #f8f9fa;
            --dark: #333;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
            --border-radius: 12px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light);
            color: var(--dark);
            line-height: 1.6;
            overflow-x: hidden;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
            min-height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Styles */
        header {
            background-color: white;
            box-shadow: var(--shadow);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            padding: 15px 0;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo img {
            height: 40px;
        }

        .logo-text {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary);
        }

        .logo-text span {
            color: var(--secondary);
        }

        .nav-menu {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .nav-menu a {
            text-decoration: none;
            color: var(--dark);
            font-weight: 500;
            padding: 8px 15px;
            border-radius: 30px;
            transition: var(--transition);
            font-size: 0.95rem;
        }

        .nav-menu a:hover {
            background-color: var(--primary);
            color: white;
        }

        .nav-menu .btn {
            background-color: var(--primary);
            color: white;
            padding: 10px 20px;
        }

        .nav-menu .btn:hover {
            background-color: var(--primary-dark);
        }

        .mobile-toggle {
            display: none;
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* Main Content */
        .main-content {
            padding-top: 100px;
            padding-bottom: 60px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .page-title {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 15px;
        }

        .page-subtitle {
            color: var(--gray);
            max-width: 700px;
            margin: 0 auto;
            font-size: 1.2rem;
        }

        /* Bookings Table */
        .bookings-container {
            background: white;
            border-radius: var(--border-radius);
            padding: 30px;
            box-shadow: var(--shadow);
            overflow-x: auto;
        }

        .bookings-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .bookings-table th,
        .bookings-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid var(--light-gray);
        }

        .bookings-table th {
            background-color: var(--primary);
            color: white;
            font-weight: 600;
        }

        .bookings-table tr:hover {
            background-color: rgba(0, 102, 204, 0.05);
        }

        .status {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .status-scheduled {
            background-color: #e3f2fd;
            color: #1976d2;
        }

        .status-boarding {
            background-color: #fff8e1;
            color: #ff8f00;
        }

        .status-departed {
            background-color: #f3e5f5;
            color: #8e24aa;
        }

        .status-arrived {
            background-color: #e8f5e9;
            color: #43a047;
        }

        .status-cancelled {
            background-color: #ffebee;
            color: #e53935;
        }

        .action-btn {
            padding: 8px 15px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-weight: 500;
            transition: var(--transition);
            font-family: 'Poppins', sans-serif;
        }

        .view-btn {
            background-color: var(--primary);
            color: white;
        }

        .view-btn:hover {
            background-color: var(--primary-dark);
        }

        .cancel-btn {
            background-color: var(--error);
            color: white;
            margin-left: 10px;
        }

        .cancel-btn:hover {
            background-color: #c53030;
        }

        .no-bookings {
            text-align: center;
            padding: 40px;
            color: var(--gray);
        }

        .no-bookings i {
            font-size: 3rem;
            margin-bottom: 20px;
            color: var(--light-gray);
        }

        .no-bookings h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .no-bookings p {
            margin-bottom: 25px;
        }

        .book-now-btn {
            display: inline-block;
            padding: 12px 25px;
            background-color: var(--secondary);
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 600;
            transition: var(--transition);
        }

        .book-now-btn:hover {
            background-color: var(--secondary-dark);
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 204, 153, 0.3);
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .page-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 768px) {
            .mobile-toggle {
                display: block;
            }

            .nav-menu {
                position: fixed;
                top: 80px;
                right: -100%;
                flex-direction: column;
                background-color: white;
                width: 300px;
                height: calc(100vh - 80px);
                padding: 40px 20px;
                transition: var(--transition);
                box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
                z-index: 999;
            }

            .nav-menu.active {
                right: 0;
            }

            .bookings-table {
                display: block;
            }

            .bookings-table thead {
                display: none;
            }

            .bookings-table tr {
                display: block;
                margin-bottom: 20px;
                border: 1px solid var(--light-gray);
                border-radius: 8px;
            }

            .bookings-table td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px 15px;
                border-bottom: 1px solid var(--light-gray);
            }

            .bookings-table td:before {
                content: attr(data-label);
                font-weight: 600;
                margin-right: 20px;
                color: var(--primary);
            }

            .bookings-table td:last-child {
                border-bottom: none;
            }

            .action-btns {
                display: flex;
                justify-content: flex-end;
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .page-title {
                font-size: 1.8rem;
            }

            .bookings-container {
                padding: 20px 15px;
            }

            .action-btn {
                padding: 6px 12px;
                font-size: 0.85rem;
            }
        }

        /* Animation Effects */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate {
            animation: fadeIn 0.8s ease forwards;
        }
    </style>
</head>

<body>
    <!-- Header -->
    @include('header')

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <div class="page-header animate">
                <h1 class="page-title">My Bookings</h1>
                <p class="page-subtitle">View and manage all your upcoming and past bus journeys</p>
            </div>

            <div class="bookings-container animate">
                @if ($bookings->isEmpty())
                    <div class="no-bookings">
                        <i class="fas fa-ticket-alt"></i>
                        <h3>No Bookings Found</h3>
                        <p>You haven't made any bookings yet. Ready to plan your next trip?</p>
                        <a href="{{ route('booking') }}" class="book-now-btn">
                            <i class="fas fa-bus"></i> Book Now
                        </a>
                    </div>
                @else
                    <table class="bookings-table">
                        <thead>
                            <tr>
                                <th>Route</th>
                                <th>Bus</th>
                                <th>Departure</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>####</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                <tr>
                                    <td data-label="Route">{{ $booking->route->name }}</td>
                                    <td data-label="Bus">{{ $booking->bus->bus_number }}</td>
                                    <td data-label="Departure">
                                        {{ \Carbon\Carbon::parse($booking->departure_time)->format('M d, Y h:i A') }}
                                    </td>
                                    <td data-label="Price">UGX {{ number_format($booking->price, 2) }}</td>
                                    <td data-label="Status">
                                        @php
                                            $now = \Carbon\Carbon::now();
                                            $departure = \Carbon\Carbon::parse($booking->departure_time);

                                            if ($departure->isFuture()) {
                                                $calculatedStatus = 'upcoming';
                                            } elseif ($departure->diffInMinutes($now) <= 30) {
                                                $calculatedStatus = 'boarding';
                                            } elseif ($departure->diffInMinutes($now) <= 180) {
                                                $calculatedStatus = 'departed';
                                            } else {
                                                $calculatedStatus = 'arrived';
                                            }
                                        @endphp

                                        <span class="status status-{{ $calculatedStatus }}">
                                            {{ ucfirst($calculatedStatus) }}
                                        </span>
                                    </td>

                                    <td>
                                        {{-- track link that leads to tracking route --}}
                                        <div class="action-btns">
                                            <a href="{{ route('tracking') }}" class="action-btn view-btn">
                                                <i class="fas fa-eye"></i> Track
                                            </a>  
                                        </div>                      
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </main>

    <script>
        // Mobile menu toggle
        document.querySelector('.mobile-toggle').addEventListener('click', function() {
            document.querySelector('.nav-menu').classList.toggle('active');
        });
    </script>
</body>

</html>
