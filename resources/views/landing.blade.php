<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Welcome') - Employee Management System</title>
    
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Inter:400,500,600,700,800" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            overflow-x: hidden;
            background: #f8fafc;
        }
        
        /* Modern Horizontal Navigation */
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }
        
        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .navbar-brand {
            display: flex;
            align-items: center;
            color: white;
            text-decoration: none;
            font-size: 1.5rem;
            font-weight: 700;
            transition: all 0.3s ease;
        }
        
        .navbar-brand:hover {
            transform: translateY(-2px);
        }
        
        .navbar-brand i {
            font-size: 1.8rem;
            margin-right: 0.75rem;
            color: white;
        }
        
        .navbar-nav {
            display: flex !important;
            align-items: center;
            gap: 2.5rem;
            list-style: none;
            margin: 0;
            padding: 0;
            flex-direction: row !important;
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            padding: 0.5rem 0;
        }
        
        .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: white;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover::before,
        .nav-link.active::before {
            width: 100%;
        }
        
        .nav-link:hover,
        .nav-link.active {
            color: white;
        }
        
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .btn-nav {
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 0.875rem;
        }
        
        .btn-nav-outline {
            background: transparent;
            color: white;
            border: 2px solid white;
        }
        
        .btn-nav-outline:hover {
            background: white;
            color: #667eea;
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(255, 255, 255, 0.3);
        }
        
        .btn-nav-primary {
            background: white;
            color: #667eea;
        }
        
        .btn-nav-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(255, 255, 255, 0.3);
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #667eea;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .user-avatar:hover {
            transform: scale(1.05);
        }
        
        /* Mobile Toggle */
        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: white;
            cursor: pointer;
        }
        
        /* Main Content */
        .main-content {
            margin-top: 80px;
            min-height: 100vh;
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 90vh;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23ffffff" fill-opacity="0.05"><path d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/></g></g></svg>') repeat;
            opacity: 0.3;
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            padding: 0 2rem;
        }
        
        .hero-title {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.1;
        }
        
        .hero-subtitle {
            font-size: 1.3rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2.5rem;
            line-height: 1.5;
        }
        
        .hero-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .btn-hero {
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
        }
        
        .btn-hero-primary {
            background: white;
            color: #667eea;
        }
        
        .btn-hero-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            color: #764ba2;
        }
        
        .btn-hero-outline {
            border: 2px solid white;
            color: white;
            background: transparent;
        }
        
        .btn-hero-outline:hover {
            background: white;
            color: #667eea;
            transform: translateY(-3px);
        }
        
        /* Stats Section */
        .stats-section {
            padding: 5rem 0;
            background: #f8fafc;
        }
        
        .stats-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }
        
        .stat-box {
            text-align: center;
            padding: 2.5rem;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
        }
        
        .stat-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .stat-icon {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 1rem;
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            color: #1e293b;
            margin: 1rem 0;
        }
        
        .stat-label {
            font-size: 1.1rem;
            color: #64748b;
            font-weight: 500;
        }
        
        /* Features Section */
        .features-section {
            padding: 5rem 0;
            background: white;
        }
        
        .section-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        
        .section-title {
            text-align: center;
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #1e293b;
        }
        
        .section-subtitle {
            text-align: center;
            font-size: 1.2rem;
            color: #64748b;
            margin-bottom: 3rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
        }
        
        .feature-card {
            text-align: center;
            padding: 2.5rem;
            border-radius: 20px;
            transition: all 0.3s;
            background: #f8fafc;
            border: 1px solid transparent;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.2);
        }
        
        .feature-icon {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .feature-card:hover .feature-icon {
            color: white;
            transform: scale(1.1);
        }
        
        .feature-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        .feature-description {
            font-size: 1rem;
            line-height: 1.6;
            opacity: 0.8;
        }
        
        /* CTA Section */
        .cta-section {
            padding: 5rem 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
        }
        
        .cta-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .cta-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        /* Footer */
        .footer {
            background: #1e293b;
            color: white;
            padding: 3rem 0 1rem;
        }
        
        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .footer-section h3 {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: white;
        }
        
        .footer-section ul {
            list-style: none;
            padding: 0;
        }
        
        .footer-section ul li {
            margin-bottom: 0.5rem;
        }
        
        .footer-section a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer-section a:hover {
            color: white;
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.7);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .navbar-container {
                padding: 1rem;
            }
            
            .navbar-nav {
                position: fixed;
                top: 70px;
                left: 0;
                right: 0;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                flex-direction: column;
                padding: 2rem;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
                transform: translateY(-100%);
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
            }
            
            .navbar-nav.active {
                transform: translateY(0);
                opacity: 1;
                visibility: visible;
            }
            
            .mobile-toggle {
                display: block;
            }
            
            .nav-actions {
                flex-direction: column;
                width: 100%;
                gap: 0.5rem;
            }
            
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
            }
            
            .hero-actions {
                flex-direction: column;
                align-items: center;
            }
            
            .btn-hero {
                width: 100%;
                max-width: 300px;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .cta-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Modern Horizontal Navigation -->
    <nav class="navbar" id="navbar">
        <div class="navbar-container">
            <a href="{{ route('home') }}" class="navbar-brand">
                <i class="fas fa-rocket"></i>
                <span>Assignly</span>
            </a>
            
            <ul class="navbar-nav" id="navbarNav">
                <li><a href="#features" class="nav-link">Features</a></li>
                <li><a href="#stats" class="nav-link">Statistics</a></li>
                <li><a href="#pricing" class="nav-link">Pricing</a></li>
                <li><a href="#footer" class="nav-link">Contact</a></li>
                
                @auth
                    <li class="nav-actions">
                        <a href="{{ route('home') }}" class="btn-nav btn-nav-outline">Dashboard</a>
                        <div class="user-avatar" title="{{ Auth::user()->name }}">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </li>
                @else
                    <li class="nav-actions">
                        <a href="{{ route('login') }}" class="btn-nav btn-nav-outline">Login</a>
                        <a href="{{ route('register') }}" class="btn-nav btn-nav-primary">Get Started</a>
                    </li>
                @endauth
            </ul>
            
            <button class="mobile-toggle" id="mobileToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>
    
    <!-- Main Content Area -->
    <div class="main-content">
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="hero-content" data-aos="fade-up">
                <h1 class="hero-title">
                    Manage Your Workforce<br>
                    <span style="color: #FFD700">Effortlessly</span>
                </h1>
                <p class="hero-subtitle">
                    Assignly helps you track employees, projects, and assignments all in one place. 
                    Streamline your workflow and boost productivity today!
                </p>
                <div class="hero-actions">
                    @guest
                        <a href="{{ route('register') }}" class="btn-hero btn-hero-primary">
                            <i class="fas fa-user-plus"></i>
                            Get Started Free
                        </a>
                        <a href="{{ route('login') }}" class="btn-hero btn-hero-outline">
                            <i class="fas fa-sign-in-alt"></i>
                            Login
                        </a>
                    @else
                        <a href="{{ route('home') }}" class="btn-hero btn-hero-primary">
                            <i class="fas fa-tachometer-alt"></i>
                            Go to Dashboard
                        </a>
                    @endguest
                </div>
            </div>
        </section>
        
        <!-- Stats Section -->
        <section id="stats" class="stats-section">
            <div class="stats-container">
                <div class="stats-grid">
                    <div class="stat-box" data-aos="fade-up">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-number">{{ $totalEmployees ?? 0 }}+</div>
                        <div class="stat-label">Active Employees</div>
                    </div>
                    
                    <div class="stat-box" data-aos="fade-up" data-aos-delay="100">
                        <div class="stat-icon">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                        <div class="stat-number">{{ $totalProjects ?? 0 }}+</div>
                        <div class="stat-label">Projects Completed</div>
                    </div>
                    
                    <div class="stat-box" data-aos="fade-up" data-aos-delay="200">
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-number">{{ number_format($totalHours ?? 0) }}+</div>
                        <div class="stat-label">Hours Tracked</div>
                    </div>
                    
                    <div class="stat-box" data-aos="fade-up" data-aos-delay="300">
                        <div class="stat-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="stat-number">4.9</div>
                        <div class="stat-label">User Rating</div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Features Section -->
        <section id="features" class="features-section">
            <div class="section-container">
                <h2 class="section-title" data-aos="fade-up">Why Choose Assignly?</h2>
                <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
                    Powerful features designed to make workforce management simple and efficient
                </p>
                
                <div class="features-grid">
                    <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="feature-icon">
                            <i class="fas fa-tachometer-alt"></i>
                        </div>
                        <h3 class="feature-title">Easy Management</h3>
                        <p class="feature-description">
                            Manage employees, projects, and assignments from a single, intuitive dashboard.
                        </p>
                    </div>
                    
                    <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="feature-title">Secure & Safe</h3>
                        <p class="feature-description">
                            Role-based access control ensures data security and privacy for your organization.
                        </p>
                    </div>
                    
                    <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="feature-title">Real-time Insights</h3>
                        <p class="feature-description">
                            Get instant analytics and reports on your team's performance and productivity.
                        </p>
                    </div>
                    
                    <div class="feature-card" data-aos="fade-up" data-aos-delay="500">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h3 class="feature-title">Responsive Design</h3>
                        <p class="feature-description">
                            Access your dashboard from any device, anywhere, with our mobile-optimized interface.
                        </p>
                    </div>
                    
                    <div class="feature-card" data-aos="fade-up" data-aos-delay="600">
                        <div class="feature-icon">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h3 class="feature-title">Fast Performance</h3>
                        <p class="feature-description">
                            Lightning-fast load times with optimized queries and modern architecture.
                        </p>
                    </div>
                    
                    <div class="feature-card" data-aos="fade-up" data-aos-delay="700">
                        <div class="feature-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h3 class="feature-title">24/7 Support</h3>
                        <p class="feature-description">
                            Dedicated support team ready to help you anytime you need assistance.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- CTA Section -->
        <section class="cta-section">
            <div class="section-container">
                <h2 class="cta-title" data-aos="fade-up">Ready to Get Started?</h2>
                <p class="cta-subtitle" data-aos="fade-up" data-aos-delay="100">
                    Join thousands of businesses using Assignly to manage their workforce efficiently.
                </p>
                @guest
                    <div class="hero-actions" data-aos="fade-up" data-aos-delay="200">
                        <a href="{{ route('register') }}" class="btn-hero btn-hero-primary">
                            <i class="fas fa-user-plus"></i>
                            Create Free Account
                        </a>
                    </div>
                @else
                    <div class="hero-actions" data-aos="fade-up" data-aos-delay="200">
                        <a href="{{ route('home') }}" class="btn-hero btn-hero-primary">
                            <i class="fas fa-tachometer-alt"></i>
                            Go to Dashboard
                        </a>
                    </div>
                @endguest
            </div>
        </section>
        
        <!-- Footer -->
        <footer id="footer" class="footer">
            <div class="footer-container">
                <div class="footer-content">
                    <div class="footer-section">
                        <h3><i class="fas fa-rocket me-2"></i>Assignly</h3>
                        <p>The ultimate solution for workforce management and team productivity.</p>
                    </div>
                    
                    <div class="footer-section">
                        <h3>Quick Links</h3>
                        <ul>
                            <li><a href="#features">Features</a></li>
                            <li><a href="#stats">Statistics</a></li>
                            <li><a href="#pricing">Pricing</a></li>
                            <li><a href="#contact">Contact</a></li>
                        </ul>
                    </div>
                    
                    <div class="footer-section">
                        <h3>Resources</h3>
                        <ul>
                            <li><a href="#">Documentation</a></li>
                            <li><a href="#">API Reference</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Support</a></li>
                        </ul>
                    </div>
                    
                    <div class="footer-section">
                        <h3>Connect With Us</h3>
                        <div>
                            <a href="#" class="text-white me-3"><i class="fab fa-facebook fa-2x"></i></a>
                            <a href="#" class="text-white me-3"><i class="fab fa-twitter fa-2x"></i></a>
                            <a href="#" class="text-white me-3"><i class="fab fa-linkedin fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-github fa-2x"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="footer-bottom">
                    <p>&copy; 2026 Assignly. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS animations
        AOS.init({
            duration: 1000,
            once: true
        });
        
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Mobile menu toggle
        const mobileToggle = document.getElementById('mobileToggle');
        const navbarNav = document.getElementById('navbarNav');
        
        mobileToggle.addEventListener('click', function() {
            navbarNav.classList.toggle('active');
            const icon = this.querySelector('i');
            if (navbarNav.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
        
        // Close mobile menu when clicking on a link
        document.querySelectorAll('.navbar-nav .nav-link, .navbar-nav .btn-nav').forEach(link => {
            link.addEventListener('click', function() {
                navbarNav.classList.remove('active');
                const icon = mobileToggle.querySelector('i');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            });
        });
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const navbarHeight = document.getElementById('navbar').offsetHeight;
                    const targetPosition = target.offsetTop - navbarHeight - 20;
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Active nav link highlighting
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link[href^="#"]');
        
        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (scrollY >= (sectionTop - 200)) {
                    current = section.getAttribute('id');
                }
            });
            
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>
