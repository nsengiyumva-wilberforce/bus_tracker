<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BusPulse - Real-time Bus Tracking</title>
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

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 100px 0 80px;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><polygon fill="rgba(255,255,255,0.05)" points="0,100 100,0 100,100"/></svg>');
            background-size: cover;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .hero img {
            height: 120px;
            margin-bottom: 30px;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2));
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .hero p {
            font-size: 1.3rem;
            margin-bottom: 40px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-nav {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            background-color: white;
            color: var(--primary);
            padding: 15px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            box-shadow: var(--shadow);
            border: 2px solid transparent;
            font-size: 1.1rem;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.2);
        }

        .btn-primary {
            background-color: var(--secondary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--secondary-dark);
        }

        .btn-secondary {
            background-color: transparent;
            color: white;
            border-color: white;
        }

        .btn-secondary:hover {
            background-color: rgba(255,255,255,0.1);
        }

        /* Features Section */
        .features {
            padding: 100px 0;
            background-color: white;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: var(--primary);
        }

        .section-subtitle {
            text-align: center;
            color: var(--gray);
            max-width: 700px;
            margin: 0 auto 60px;
            font-size: 1.2rem;
        }

        .features-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .feature-box {
            background: white;
            border-radius: var(--border-radius);
            padding: 40px 30px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: var(--transition);
            border-top: 4px solid var(--secondary);
        }

        .feature-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.15);
        }

        .feature-icon {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .feature-box h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: var(--dark);
        }

        /* Dashboard Section */
        .dashboard {
            padding: 100px 0;
            background-color: var(--light-gray);
        }

        .dashboard-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .dashboard-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 30px;
            box-shadow: var(--shadow);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            border-left: 5px solid var(--primary);
        }

        .dashboard-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
        }

        .dashboard-card h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: var(--primary);
        }

        .dashboard-card p {
            margin-bottom: 20px;
        }

        .dashboard-card .btn {
            padding: 10px 20px;
            font-size: 0.9rem;
        }

        /* Testimonials */
        .testimonials {
            padding: 100px 0;
            background-color: white;
        }

        .testimonials-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .testimonial {
            background: white;
            border-radius: var(--border-radius);
            padding: 30px;
            box-shadow: var(--shadow);
            position: relative;
        }

        .testimonial::before {
            content: """;
            font-family: Georgia, serif;
            font-size: 5rem;
            color: var(--secondary);
            position: absolute;
            top: -20px;
            left: 10px;
            opacity: 0.3;
        }

        .testimonial-content {
            margin-bottom: 20px;
            font-style: italic;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
        }

        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            margin-right: 15px;
        }

        .author-info h4 {
            margin-bottom: 5px;
        }

        .author-info p {
            color: var(--gray);
            font-size: 0.9rem;
        }

        /* Footer */
        footer {
            background-color: var(--dark);
            color: white;
            padding: 60px 0 30px;
        }

        .footer-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-col h4 {
            font-size: 1.3rem;
            margin-bottom: 25px;
            position: relative;
        }

        .footer-col h4::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -10px;
            width: 50px;
            height: 2px;
            background-color: var(--secondary);
        }

        .footer-col p {
            margin-bottom: 20px;
            opacity: 0.8;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 15px;
        }

        .footer-links a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: var(--secondary);
            padding-left: 5px;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: rgba(255,255,255,0.1);
            border-radius: 50%;
            color: white;
            transition: var(--transition);
        }

        .social-links a:hover {
            background-color: var(--secondary);
            transform: translateY(-3px);
        }

        .copyright {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255,255,255,0.1);
            opacity: 0.7;
            font-size: 0.9rem;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .hero h1 {
                font-size: 3rem;
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
            
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero p {
                font-size: 1.1rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 576px) {
            .hero {
                padding: 120px 0 60px;
            }
            
            .hero h1 {
                font-size: 2rem;
            }
            
            .hero-nav {
                flex-direction: column;
                align-items: center;
            }
            
            .btn {
                width: 100%;
                max-width: 300px;
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

        .delay-1 {
            animation-delay: 0.2s;
        }

        .delay-2 {
            animation-delay: 0.4s;
        }

        .delay-3 {
            animation-delay: 0.6s;
        }
        
        /* Auth forms */
        .auth-container {
            max-width: 500px;
            margin: 100px auto;
            padding: 40px;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
        }
        
        .auth-title {
            text-align: center;
            margin-bottom: 30px;
            color: var(--primary);
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
        }
        
        .form-group input:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
        }
        
        .auth-btn {
            display: block;
            width: 100%;
            padding: 15px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .auth-btn:hover {
            background-color: var(--primary-dark);
        }
        
        .auth-links {
            text-align: center;
            margin-top: 20px;
        }
        
        .auth-links a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }
        
        .auth-links a:hover {
            text-decoration: underline;
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
                <a href="#">Home</a>
                <a href="#">About</a>
                <a href="#">Services</a>
                <a href="#">Contact</a>
                
                <!-- Authentication State -->
                <div id="auth-state">
                    @auth
                        <a href="{{ route('booking') }}">Booking</a>
                        <a href="{{ route('tracking.index') }}">Tracking</a>
                        <a href="#">Stations</a>
                        <a href="{{ route('routes.index') }}">Routes</a>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="btn">Logout</a>
                    @else
                        <a href="{{ route('login') }}" class="btn">Login</a>
                        <a href="{{ url('/register') }}" class="btn" style="background-color: var(--primary); color: white;">Sign Up</a>
                    @endauth
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @if(request()->is('login') || request()->is('register'))
            <!-- Auth Content -->
            <div class="auth-container">
                @if(request()->is('login'))
                    <h2 class="auth-title">Login to BusPulse</h2>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <button type="submit" class="auth-btn">Login</button>
                        <div class="auth-links">
                            <a href="{{ route('password.request') }}">Forgot Password?</a> | 
                            <a href="{{ route('register') }}">Create Account</a>
                        </div>
                    </form>
                @elseif(request()->is('register'))
                    <h2 class="auth-title">Create BusPulse Account</h2>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="auth-btn">Register</button>
                        <div class="auth-links">
                            Already have an account? <a href="{{ route('login') }}">Login</a>
                        </div>
                    </form>
                @endif
            </div>
        @else
            <!-- Hero Section -->
            <section class="hero">
                <div class="container hero-content">
                    <img src="{{ asset('images/logo1.png') }}" alt="BusPulse Logo">
                    
                    @auth
                        <h1>Welcome back, {{ auth()->user()->first_name }}!</h1>
                        <p>Access your bookings and track your buses in real-time.</p>
                        <div class="hero-nav">
                            <a href="#" class="btn btn-primary">My Bookings</a>
                            <a href="{{ route('tracking.index') }}" class="btn btn-secondary">Live Tracking</a>
                            <a href="#" class="btn btn-secondary">Stations</a>
                        </div>
                    @else
                        <h1>Welcome to BusPulse</h1>
                        <p>Real-time bus tracking for passengers and operators.</p>
                        <div class="hero-nav">
                            <a href="{{ url('/register') }}" class="btn btn-primary">Sign Up</a>
                            <a href="{{ route('login') }}" class="btn btn-secondary">Login</a>
                        </div>
                    @endauth
                </div>
            </section>

            <!-- Features Section -->
            <section class="features">
                <div class="container">
                    <h2 class="section-title animate">Why Choose BusPulse?</h2>
                    <p class="section-subtitle animate delay-1">Experience the future of bus transportation with our innovative solutions</p>
                    
                    <div class="features-container">
                        <div class="feature-box animate delay-1">
                            <div class="feature-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <h3>Live Bus Tracking</h3>
                            <p>Monitor bus movement in real-time with accurate GPS data. Never miss your bus again!</p>
                        </div>
                        
                        <div class="feature-box animate delay-2">
                            <div class="feature-icon">
                                <i class="fas fa-ticket-alt"></i>
                            </div>
                            <h3>Easy Ticket Booking</h3>
                            <p>Book and manage your tickets online with our simple and secure booking system.</p>
                        </div>
                        
                        <div class="feature-box animate delay-3">
                            <div class="feature-icon">
                                <i class="fas fa-bus-alt"></i>
                            </div>
                            <h3>Driver Location Updates</h3>
                            <p>Get real-time updates about driver status, arrival times, and route changes.</p>
                        </div>
                    </div>
                </div>
            </section>

            @auth
            <!-- Dashboard Section -->
            <section class="dashboard">
                <div class="container">
                    <h2 class="section-title">Your Dashboard</h2>
                    <p class="section-subtitle">Quick access to your most important features</p>
                    
                    <div class="dashboard-container">
                        <div class="dashboard-card">
                            <h3>Book a Trip</h3>
                            <p>Find and book your next bus journey with our easy booking system.</p>
                            <a href="#" class="btn">Book Now</a>
                        </div>
                        
                        <div class="dashboard-card">
                            <h3>Track Your Bus</h3>
                            <p>See exactly where your bus is and when it will arrive at your stop.</p>
                            <a href="{{ route('tracking.index') }}" class="btn">Start Tracking</a>
                        </div>
                        
                        <div class="dashboard-card">
                            <h3>View Stations</h3>
                            <p>Find stations near you and see departure schedules.</p>
                            <a href="#" class="btn">Explore Stations</a>
                        </div>
                        
                        <div class="dashboard-card">
                            <h3>Bus Routes</h3>
                            <p>Discover all available routes and plan your journey.</p>
                            <a href="{{ route('routes.index') }}" class="btn">View Routes</a>
                        </div>
                    </div>
                </div>
            </section>
            @endif

            <!-- Testimonials Section -->
            <section class="testimonials">
                <div class="container">
                    <h2 class="section-title">What Our Passengers Say</h2>
                    <p class="section-subtitle">Hear from our satisfied customers about their experiences</p>
                    
                    <div class="testimonials-container">
                        <div class="testimonial">
                            <div class="testimonial-content">
                                "BusPulse has completely changed my commute! The real-time tracking feature is incredibly accurate and has saved me so much waiting time."
                            </div>
                            <div class="testimonial-author">
                                <div class="author-avatar">SR</div>
                                <div class="author-info">
                                    <h4>Nsengiyumva Wilberforce</h4>
                                    <p>Daily Commuter</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="testimonial">
                            <div class="testimonial-content">
                                "The mobile app is so convenient. Booking tickets takes seconds, and I love getting notifications about my bus location. Highly recommended!"
                            </div>
                            <div class="testimonial-author">
                                <div class="author-avatar">MR</div>
                                <div class="author-info">
                                    <h4>Anita Senjala</h4>
                                    <p>Frequent Traveler</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="testimonial">
                            <div class="testimonial-content">
                                "As a parent, I feel so much better knowing exactly when the bus will arrive. The driver updates give me peace of mind for my kids."
                            </div>
                            <div class="testimonial-author">
                                <div class="author-avatar">EP</div>
                                <div class="author-info">
                                    <h4>Hellen</h4>
                                    <p>Parent</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-container">
                <div class="footer-col">
                    <div class="logo" style="margin-bottom: 20px;">
                        <img src="{{ asset('images/logo1.png') }}" alt="BusPulse Logo" style="height: 40px;">
                        <div class="logo-text" style="color: white;">Bus<span style="color: var(--secondary);">Pulse</span></div>
                    </div>
                    <p>Real-time bus tracking for passengers and operators. Making public transportation smarter and more reliable.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                
                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Pricing</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h4>Our Services</h4>
                    <ul class="footer-links">
                        <li><a href="#">Live Bus Tracking</a></li>
                        <li><a href="#">Online Booking</a></li>
                        <li><a href="#">Route Planning</a></li>
                        <li><a href="#">Driver Management</a></li>
                        <li><a href="#">Fleet Analytics</a></li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h4>Contact Us</h4>
                    <p><i class="fas fa-map-marker-alt"></i> 123 Transport St, City Center</p>
                    <p><i class="fas fa-phone"></i> +1 (555) 123-4567</p>
                    <p><i class="fas fa-envelope"></i> info@buspulse.com</p>
                </div>
            </div>
            
            <div class="copyright">
                &copy; 2023 BusPulse. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Hidden logout form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script>
        // Toggle mobile menu
        document.querySelector('.mobile-toggle').addEventListener('click', function() {
            document.querySelector('.nav-menu').classList.toggle('active');
        });
        
        // Animation on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate');
                    }
                });
            }, { threshold: 0.1 });
            
            document.querySelectorAll('.feature-box, .testimonial').forEach((el, index) => {
                el.classList.add(`delay-${(index % 3) + 1}`);
                observer.observe(el);
            });
        });
    </script>
</body>
</html>