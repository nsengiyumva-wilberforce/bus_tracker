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

        /* Booking Form */
        .booking-form {
            background: white;
            border-radius: var(--border-radius);
            padding: 40px 30px;
            box-shadow: var(--shadow);
            max-width: 800px;
            margin: 0 auto;
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
            font-family: 'Poppins', sans-serif;
        }

        .form-control:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
        }

        @media (min-width: 768px) {
            .form-row {
                grid-template-columns: 1fr 1fr;
            }
        }

        .error-message {
            color: var(--error);
            font-size: 0.85rem;
            margin-top: 5px;
            display: block;
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
            font-family: 'Poppins', sans-serif;
        }

        .form-submit:hover {
            background-color: var(--secondary-dark);
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 204, 153, 0.3);
        }

        .is-invalid {
            border-color: var(--error);
        }

        .is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(229, 62, 62, 0.1);
        }

        .required {
            color: var(--error);
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 20px;
            border-radius: 8px;
            margin-top: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
            animation: fadeIn 0.5s ease;
        }
        
        .success-message i {
            font-size: 1.5rem;
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
        }

        @media (max-width: 576px) {
            .page-title {
                font-size: 1.8rem;
            }
            
            .booking-form {
                padding: 30px 20px;
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
                <h1 class="page-title">Book Your Journey</h1>
                <p class="page-subtitle">Select your route, departure time, bus, and ticket price for a comfortable travel experience</p>
            </div>

            <div class="booking-form animate">
                <h2 class="form-title">Booking Details</h2>
                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="route_id">Select Route <span class="required">*</span></label>
                            <select name="route_id" id="route_id" class="form-control @error('route_id') is-invalid @enderror" required>
                                <option value="">-- Choose Route --</option>
                                @foreach ($routes as $route)
                                    <option value="{{ $route->id }}" {{ old('route_id') == $route->id ? 'selected' : '' }}>
                                        {{ $route->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('route_id')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="bus_id">Select Bus <span class="required">*</span></label>
                            <select name="bus_id" id="bus_id" class="form-control @error('bus_id') is-invalid @enderror" required>
                                <option value="">-- Choose Bus --</option>
                                @foreach ($buses as $bus)
                                    <option value="{{ $bus->id }}" {{ old('bus_id') == $bus->id ? 'selected' : '' }}>
                                        {{ $bus->bus_number }} (Capacity: {{ $bus->capacity }})
                                    </option>
                                @endforeach
                            </select>
                            @error('bus_id')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="departure_time">Departure Time <span class="required">*</span></label>
                            <select name="departure_time" id="departure_time" class="form-control @error('departure_time') is-invalid @enderror" required>
                                <option value="">-- Choose Departure Time --</option>
                                <option value="08:00" {{ old('departure_time') == '08:00' ? 'selected' : '' }}>8:00 am</option>
                                <option value="10:00" {{ old('departure_time') == '10:00' ? 'selected' : '' }}>10:00 am</option>
                                <option value="12:00" {{ old('departure_time') == '12:00' ? 'selected' : '' }}>12:00</option>
                                <option value="14:00" {{ old('departure_time') == '14:00' ? 'selected' : '' }}>2:00 pm</option>
                            </select>
                            @error('departure_time')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price">Ticket Price (UGX) <span class="required">*</span></label>
                            <input type="number" name="price" id="price" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                                   value="3000" required placeholder="Enter ticket price">
                            @error('price')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="form-submit">
                        <i class="fas fa-ticket-alt"></i> Book Now
                    </button>
                    
                    @if(session('success'))
                        <div class="success-message">
                            <i class="fas fa-check-circle"></i>
                            <div>
                                <h3>Booking Successful!</h3>
                                <p>{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </main>

    <script>
        // Mobile menu toggle
        document.querySelector('.mobile-toggle').addEventListener('click', function() {
            document.querySelector('.nav-menu').classList.toggle('active');
        });
        
        // Set default datetime to now if not already set
        document.addEventListener('DOMContentLoaded', function() {
            const timeInput = document.getElementById('departure_time');
            if (!timeInput.value) {
                const now = new Date();
                // Adjust for timezone offset
                const timezoneOffset = now.getTimezoneOffset() * 60000;
                const localISOTime = new Date(now - timezoneOffset).toISOString().slice(0, 16);
                timeInput.value = localISOTime;
            }
            
            // Highlight invalid fields on page load
            document.querySelectorAll('.is-invalid').forEach(el => {
                el.scrollIntoView({ behavior: 'smooth', block: 'center' });
            });
        });
    </script>
</body>
</html>