<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Your Trip - BusPulse</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0066cc;
            --primary-dark: #004d99;
            --secondary: #00cc99;
            --secondary-dark: #00aa77;
            --accent: #ff6b6b;
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

        /* Booking Container */
        .booking-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 40px;
        }

        @media (min-width: 992px) {
            .booking-container {
                grid-template-columns: 1fr 1fr;
            }
        }

        /* Booking Form */
        .booking-form {
            background: white;
            border-radius: var(--border-radius);
            padding: 40px 30px;
            box-shadow: var(--shadow);
        }

        .form-title {
            font-size: 1.8rem;
            color: var(--primary);
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--light-gray);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
            background-color: white;
        }

        .form-control:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .form-submit {
            display: block;
            width: 100%;
            padding: 15px;
            background-color: var(--secondary);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            margin-top: 20px;
        }

        .form-submit:hover {
            background-color: var(--secondary-dark);
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 204, 153, 0.3);
        }

        /* Booking Summary */
        .booking-summary {
            background: white;
            border-radius: var(--border-radius);
            padding: 30px;
            box-shadow: var(--shadow);
            align-self: start;
            position: sticky;
            top: 120px;
        }

        .summary-title {
            font-size: 1.5rem;
            color: var(--primary);
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--light-gray);
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px dashed var(--light-gray);
        }

        .summary-label {
            color: var(--gray);
        }

        .summary-value {
            font-weight: 500;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 2px solid var(--light-gray);
            font-size: 1.2rem;
            font-weight: 600;
        }

        .summary-price {
            color: var(--secondary);
            font-size: 1.4rem;
        }

        /* Bus Preview */
        .bus-preview {
            background: white;
            border-radius: var(--border-radius);
            padding: 30px;
            box-shadow: var(--shadow);
            margin-top: 40px;
        }

        .bus-title {
            font-size: 1.5rem;
            color: var(--primary);
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--light-gray);
        }

        .bus-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .bus-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 20px;
        }

        .bus-detail {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .bus-detail i {
            color: var(--primary);
            font-size: 1.2rem;
        }

        /* Seat Selection */
        .seat-selection {
            background: white;
            border-radius: var(--border-radius);
            padding: 30px;
            box-shadow: var(--shadow);
            margin-top: 40px;
        }

        .seat-title {
            font-size: 1.5rem;
            color: var(--primary);
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--light-gray);
        }

        .bus-layout {
            background: #f0f8ff;
            border-radius: 10px;
            padding: 30px;
            position: relative;
        }

        .bus-driver {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--dark);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .seats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-top: 60px;
        }

        .seat {
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e1ecf7;
            border-radius: 8px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
            position: relative;
        }

        .seat:before {
            content: "";
            position: absolute;
            top: 5px;
            left: 5px;
            right: 5px;
            bottom: 5px;
            border: 2px dashed #b3d1f0;
            border-radius: 5px;
        }

        .seat:hover {
            background: #c0dbf5;
            transform: translateY(-3px);
        }

        .seat.selected {
            background: var(--secondary);
            color: white;
        }

        .seat.selected:before {
            border-color: rgba(255, 255, 255, 0.3);
        }

        .seat.occupied {
            background: #f8d7da;
            cursor: not-allowed;
            color: #721c24;
        }

        .seat.occupied:before {
            border-color: #f5c6cb;
        }

        .seat-legend {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 4px;
        }

        .available-color {
            background: #e1ecf7;
        }

        .selected-color {
            background: var(--secondary);
        }

        .occupied-color {
            background: #f8d7da;
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

            .form-row {
                grid-template-columns: 1fr;
            }

            .bus-details {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .page-title {
                font-size: 1.8rem;
            }

            .seats-grid {
                grid-template-columns: repeat(2, 1fr);
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

                .styled-table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-top: 1rem;
            font-size: 0.95rem;
        }

        .styled-table thead {
            background-color: var(--primary, #007bff);
            color: white;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .styled-table tr:hover {
            background-color: #f9f9f9;
        }

        .badge.bg-info {
            background-color: var(--primary, #007bff);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            margin-right: 4px;
            font-size: 0.8rem;
        }
    </style>
</head>

<body>
    @include('header')

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <div class="page-header animate">
                <h1 class="page-title">The following are our stations</h1>
                <p class="page-subtitle">You can wait for us from any</p>
            </div>

            {{-- Styled Routes Table --}}
            <div class="table-responsive">
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Station Name</th>
                            <th>Location</th>
                            <th>GPS coordinates</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stations as $station)
                            <tr>
                                <td class="fw-semibold">{{ $station->name }}</td>
                                <td>{{ $station->location }}</td>
                                <td>
                                    @if ($station->latitude && $station->longitude)
                                        <span class="badge bg-info">
                                            <i class="fas fa-map-marker-alt me-2"></i>
                                            {{ number_format($station->latitude, 6) }},
                                            {{ number_format($station->longitude, 6) }}
                                        </span>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>


    <!-- Hidden logout form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

</body>

</html>
