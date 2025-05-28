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
            --shadow: 0 4px 12px rgba(0,0,0,0.1);
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
            border-color: rgba(255,255,255,0.3);
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
                box-shadow: -5px 0 15px rgba(0,0,0,0.1);
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
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate {
            animation: fadeIn 0.8s ease forwards;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container header-container">
            <div class="logo">
                <img src="{{ asset('images/logo1.png') }}" alt="BusPulse Logo">
                <div class="logo-text">Bus<span>Pulse</span></div>
            </div>
            
            <div class="mobile-toggle">
                <i class="fas fa-bars"></i>
            </div>
            
            <nav class="nav-menu">
                <a href="/">Home</a>
                <a href="#">Booking</a>
                <a href="{{ route('tracking.index') }}">Tracking</a>
                <a href="#">Stations</a>
                <a href="{{ route('routes.index') }}">Routes</a>
                
                @auth
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="btn">Logout</a>
                @else
                    <a href="{{ route('login') }}" class="btn">Login</a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <div class="page-header animate">
                <h1 class="page-title">Book Your Journey</h1>
                <p class="page-subtitle">Select your route, departure time, bus, and preferred seat for a comfortable travel experience</p>
            </div>
            
            <div class="booking-container">
                <!-- Booking Form -->
                <div class="booking-form animate">
                    <h2 class="form-title">Travel Details</h2>
                    
                    <form id="bookingForm">
                        @csrf
                        
                        <div class="form-group">
                            <label for="route">Select Route</label>
                            <select id="route" class="form-control" required>
                                <option value="">Choose your route</option>
                                @foreach($routes as $route)
                                    <option value="{{ $route->id }}" 
                                        data-start="{{ $route->starting_station_id }}"
                                        data-end="{{ $route->ending_station_id }}"
                                        data-timetable="{{ json_encode($route->timetable) }}">
                                        {{ $route->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="departure">Departure Station</label>
                                <select id="departure" class="form-control" required>
                                    <option value="">Select station</option>
                                    @foreach($busStops as $stop)
                                        <option value="{{ $stop->id }}">{{ $stop->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="arrival">Arrival Station</label>
                                <select id="arrival" class="form-control" required>
                                    <option value="">Select station</option>
                                    @foreach($busStops as $stop)
                                        <option value="{{ $stop->id }}">{{ $stop->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="date">Travel Date</label>
                            <input type="date" id="date" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="time">Departure Time</label>
                            <select id="time" class="form-control" required>
                                <option value="">Select time</option>
                                <!-- Times will be populated dynamically based on route selection -->
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="bus">Select Bus</label>
                            <select id="bus" class="form-control" required>
                                <option value="">Choose your bus</option>
                                @foreach($buses as $bus)
                                    <option value="{{ $bus->id }}" data-capacity="{{ $bus->capacity }}">
                                        {{ $bus->bus_number }} (Capacity: {{ $bus->capacity }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="passengers">Number of Passengers</label>
                            <select id="passengers" class="form-control" required>
                                <option value="1">1 Passenger</option>
                                <option value="2">2 Passengers</option>
                                <option value="3">3 Passengers</option>
                                <option value="4">4 Passengers</option>
                                <option value="5">5 Passengers</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="form-submit">Proceed to Payment</button>
                    </form>
                </div>
                
                <!-- Booking Summary -->
                <div class="booking-summary animate">
                    <h2 class="summary-title">Booking Summary</h2>
                    
                    <div class="summary-item">
                        <div class="summary-label">Route:</div>
                        <div class="summary-value" id="summary-route">Not selected</div>
                    </div>
                    
                    <div class="summary-item">
                        <div class="summary-label">Departure:</div>
                        <div class="summary-value" id="summary-departure">Not selected</div>
                    </div>
                    
                    <div class="summary-item">
                        <div class="summary-label">Arrival:</div>
                        <div class="summary-value" id="summary-arrival">Not selected</div>
                    </div>
                    
                    <div class="summary-item">
                        <div class="summary-label">Date:</div>
                        <div class="summary-value" id="summary-date">Not selected</div>
                    </div>
                    
                    <div class="summary-item">
                        <div class="summary-label">Time:</div>
                        <div class="summary-value" id="summary-time">Not selected</div>
                    </div>
                    
                    <div class="summary-item">
                        <div class="summary-label">Bus:</div>
                        <div class="summary-value" id="summary-bus">Not selected</div>
                    </div>
                    
                    <div class="summary-item">
                        <div class="summary-label">Passengers:</div>
                        <div class="summary-value" id="summary-passengers">1</div>
                    </div>
                    
                    <div class="summary-total">
                        <div>Total:</div>
                        <div class="summary-price" id="summary-price">UGX 15,000</div>
                    </div>
                </div>
            </div>
            
            <!-- Seat Selection -->
            <div class="seat-selection animate">
                <h2 class="seat-title">Select Your Seat</h2>
                <p>Choose your preferred seat from the available options below</p>
                
                <div class="bus-layout">
                    <div class="bus-driver">Driver</div>
                    <div class="seats-grid">
                        <!-- Seats will be generated dynamically based on bus capacity -->
                    </div>
                    
                    <div class="seat-legend">
                        <div class="legend-item">
                            <div class="legend-color available-color"></div>
                            <span>Available</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color selected-color"></div>
                            <span>Selected</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color occupied-color"></div>
                            <span>Occupied</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Bus Preview -->
            <div class="bus-preview animate">
                <h2 class="bus-title">Bus Information</h2>
                <div class="bus-image" id="bus-image-text">
                    Select a bus to view details
                </div>
                <p id="bus-description">Our buses feature comfortable seating, air conditioning, and other amenities for a relaxing journey.</p>
                
                <div class="bus-details">
                    <div class="bus-detail">
                        <i class="fas fa-users"></i>
                        <span id="bus-capacity">Capacity: Not selected</span>
                    </div>
                    <div class="bus-detail">
                        <i class="fas fa-snowflake"></i>
                        <span>Air Conditioning</span>
                    </div>
                    <div class="bus-detail">
                        <i class="fas fa-wifi"></i>
                        <span>Free WiFi</span>
                    </div>
                    <div class="bus-detail">
                        <i class="fas fa-plug"></i>
                        <span>Power Outlets</span>
                    </div>
                    <div class="bus-detail">
                        <i class="fas fa-tv"></i>
                        <span>Entertainment System</span>
                    </div>
                    <div class="bus-detail">
                        <i class="fas fa-wheelchair"></i>
                        <span>Wheelchair Accessible</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Hidden logout form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script>
        // Toggle mobile menu
        document.querySelector('.mobile-toggle').addEventListener('click', function() {
            document.querySelector('.nav-menu').classList.toggle('active');
        });
        
        // Set today as default date
        const today = new Date();
        const formattedDate = today.toISOString().split('T')[0];
        document.getElementById('date').value = formattedDate;
        document.getElementById('summary-date').textContent = new Date().toLocaleDateString('en-US', { 
            weekday: 'short', 
            year: 'numeric', 
            month: 'short', 
            day: 'numeric' 
        });
        
        // Update summary as user makes selections
        const routeSelect = document.getElementById('route');
        const departureSelect = document.getElementById('departure');
        const arrivalSelect = document.getElementById('arrival');
        const timeSelect = document.getElementById('time');
        const busSelect = document.getElementById('bus');
        const passengersSelect = document.getElementById('passengers');
        const dateInput = document.getElementById('date');
        
        // When route changes, update departure and arrival stations
        routeSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const startId = selectedOption.dataset.start;
            const endId = selectedOption.dataset.end;
            const timetable = JSON.parse(selectedOption.dataset.timetable || '[]');
            
            // Update departure and arrival dropdowns
            departureSelect.value = startId;
            arrivalSelect.value = endId;
            
            // Update time options
            timeSelect.innerHTML = '<option value="">Select time</option>';
            timetable.forEach(time => {
                timeSelect.innerHTML += `<option value="${time}">${time}</option>`;
            });
            
            updateSummary();
        });
        
        // When bus changes, update seats and bus details
        busSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const capacity = selectedOption.dataset.capacity || 0;
            
            // Update bus image text
            document.getElementById('bus-image-text').textContent = 
                `Bus ${selectedOption.text}`;
            
            // Update capacity
            document.getElementById('bus-capacity').textContent = 
                `Capacity: ${capacity} seats`;
            
            // Generate seats based on capacity
            generateSeats(capacity);
            
            updateSummary();
        });
        
        function generateSeats(capacity) {
            const seatsGrid = document.querySelector('.seats-grid');
            seatsGrid.innerHTML = '';
            
            // Simple seat generation - in a real app, you'd get actual seat layout from the database
            const rows = Math.ceil(capacity / 4);
            let seatNumber = 1;
            
            for (let row = 1; row <= rows; row++) {
                for (let col = 1; col <= 4; col++) {
                    if (seatNumber > capacity) break;
                    
                    const seatCode = `${String.fromCharCode(64 + row)}${col}`;
                    const isOccupied = Math.random() < 0.2; // 20% chance seat is occupied for demo
                    
                    const seat = document.createElement('div');
                    seat.className = `seat ${isOccupied ? 'occupied' : ''}`;
                    seat.dataset.seat = seatCode;
                    seat.textContent = seatCode;
                    
                    if (!isOccupied) {
                        seat.addEventListener('click', function() {
                            // Deselect all other seats
                            document.querySelectorAll('.seat:not(.occupied)').forEach(s => {
                                s.classList.remove('selected');
                            });
                            
                            // Select clicked seat
                            this.classList.add('selected');
                        });
                    }
                    
                    seatsGrid.appendChild(seat);
                    seatNumber++;
                }
            }
        }
        
        function updateSummary() {
            document.getElementById('summary-route').textContent = 
                routeSelect.options[routeSelect.selectedIndex]?.text || 'Not selected';
            
            document.getElementById('summary-departure').textContent = 
                departureSelect.options[departureSelect.selectedIndex]?.text || 'Not selected';
            
            document.getElementById('summary-arrival').textContent = 
                arrivalSelect.options[arrivalSelect.selectedIndex]?.text || 'Not selected';
            
            document.getElementById('summary-time').textContent = 
                timeSelect.options[timeSelect.selectedIndex]?.text || 'Not selected';
            
            document.getElementById('summary-bus').textContent = 
                busSelect.options[busSelect.selectedIndex]?.text || 'Not selected';
            
            document.getElementById('summary-passengers').textContent = 
                passengersSelect.value;
            
            // Calculate price in UGX
            const basePrice = 15000;
            const passengers = parseInt(passengersSelect.value);
            document.getElementById('summary-price').textContent = 
                'UGX ' + (basePrice * passengers).toLocaleString('en-US');
        }
        
        // Add event listeners to form elements
        [routeSelect, departureSelect, arrivalSelect, timeSelect, busSelect, passengersSelect, dateInput].forEach(el => {
            el.addEventListener('change', updateSummary);
        });
        
        // Initialize summary
        updateSummary();
        
        // Form submission
        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Check if a seat is selected
            const selectedSeat = document.querySelector('.seat.selected');
            if (!selectedSeat) {
                alert('Please select a seat before proceeding.');
                return;
            }
            
            // Form is valid, proceed to payment
            alert('Booking successful! Redirecting to payment...');
            // In a real app, you would submit the form to the server
        });
        
        // Set a sample route and bus for demo if needed
        setTimeout(() => {
            if (routeSelect.options.length > 1) {
                routeSelect.value = routeSelect.options[1].value;
                routeSelect.dispatchEvent(new Event('change'));
            }
            
            if (busSelect.options.length > 1) {
                busSelect.value = busSelect.options[1].value;
                busSelect.dispatchEvent(new Event('change'));
            }
        }, 500);
    </script>
</body>
</html>