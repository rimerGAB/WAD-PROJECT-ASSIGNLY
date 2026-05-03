<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Assignly - Employee Management System</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Inter:400,500,600,700" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <!-- Vertical Navigation for Authenticated Users -->
        @auth
            <div class="nav-layout">
                <!-- Vertical Sidebar -->
                <nav class="nav-vertical" id="mainNav">
                    <div class="nav-header">
                        <a href="{{ url('/') }}" class="nav-brand">
                            <i class="fas fa-rocket"></i>
                            <span>Assignly</span>
                        </a>
                    </div>
                    
                    <div class="nav-body">
                        <!-- Main Navigation -->
                        <div class="nav-section">
                            <div class="nav-section-title">Main</div>
                            <div class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <span>Dashboard</span>
                                </a>
                            </div>
                            <div class="nav-item">
                                <a href="{{ route('employees.index') }}" class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}">
                                    <i class="fas fa-users"></i>
                                    <span>Employees</span>
                                </a>
                            </div>
                            <div class="nav-item">
                                <a href="{{ route('projects.index') }}" class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}">
                                    <i class="fas fa-project-diagram"></i>
                                    <span>Projects</span>
                                </a>
                            </div>
                            <div class="nav-item">
                                <a href="{{ route('assignments.index') }}" class="nav-link {{ request()->routeIs('assignments.*') ? 'active' : '' }}">
                                    <i class="fas fa-tasks"></i>
                                    <span>Assignments</span>
                                </a>
                            </div>
                            @if(auth()->user()->is_admin)
                                <div class="nav-item">
                                    <a href="{{ route('departments.index') }}" class="nav-link {{ request()->routeIs('departments.*') ? 'active' : '' }}">
                                        <i class="fas fa-building"></i>
                                        <span>Departments</span>
                                    </a>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Analytics -->
                        <div class="nav-section">
                            <div class="nav-section-title">Analytics</div>
                            <div class="nav-item">
                                <a href="{{ route('home') }}#analytics" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                                    <i class="fas fa-chart-line"></i>
                                    <span>Statistics</span>
                                </a>
                            </div>
                            <div class="nav-item">
                                <a href="{{ route('home') }}#time-tracking" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                                    <i class="fas fa-clock"></i>
                                    <span>Time Tracking</span>
                                </a>
                            </div>
                            <div class="nav-item">
                                <a href="{{ route('home') }}#reports" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                                    <i class="fas fa-file-alt"></i>
                                    <span>Reports</span>
                                </a>
                            </div>
                        </div>
                        
                        <div class="nav-section">
                            <div class="nav-section-title">Account</div>
                            <div class="nav-item">
                                <a href="{{ route('employees.show', auth()->id()) }}" class="nav-link {{ request()->routeIs('employees.show') ? 'active' : '' }}">
                                    <i class="fas fa-id-card"></i>
                                    <span>My Profile</span>
                                </a>
                            </div>
                            <div class="nav-item">
                                <a href="#" id="logoutLink" class="nav-link" role="button">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>
                
                <!-- Mobile Toggle -->
                <button class="nav-mobile-toggle" id="navMobileToggle">
                    <i class="fas fa-bars"></i>
                </button>
                
                <!-- Main Content Area -->
                <div class="nav-main-content">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('warning'))
                        <div class="alert alert-warning" role="alert">
                            {{ session('warning') }}
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @yield('content')
                </div>
            </div>
            
            <!-- Hidden Logout Form -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            <div class="auth-modal-overlay" id="logoutModal" aria-hidden="true">
                <div class="auth-modal" role="dialog" aria-modal="true" aria-labelledby="logoutModalTitle">
                    <button type="button" class="auth-modal-close" id="logoutModalClose" aria-label="Close logout confirmation">×</button>
                    <div class="auth-modal-header">
                        <h2 id="logoutModalTitle">Confirm Logout</h2>
                    </div>
                    <p class="auth-modal-text">You are about to sign out. If you continue, you will need to log in again to access your dashboard.</p>
                    <div class="auth-modal-actions">
                        <button type="button" class="btn btn-secondary" id="cancelLogout">Cancel</button>
                        <button type="button" class="btn btn-primary" id="confirmLogout">Logout</button>
                    </div>
                </div>
            </div>

            <div class="auth-modal-overlay" id="deleteConfirmModal" aria-hidden="true">
                <div class="auth-modal" role="dialog" aria-modal="true" aria-labelledby="deleteConfirmModalTitle">
                    <button type="button" class="auth-modal-close" id="deleteConfirmModalClose" aria-label="Close delete confirmation">×</button>
                    <div class="auth-modal-header">
                        <h2 id="deleteConfirmModalTitle">Confirm Delete</h2>
                    </div>
                    <p class="auth-modal-text" id="deleteConfirmMessage">Are you sure you want to delete this item?</p>
                    <div class="auth-modal-actions">
                        <button type="button" class="btn btn-secondary" id="cancelDelete">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                    </div>
                </div>
            </div>
        @else
            <!-- Horizontal Navigation for Guests -->
            <nav class="nav-horizontal">
                <div class="nav-container">
                    <a href="{{ url('/') }}" class="nav-brand">
                        <i class="fas fa-rocket"></i>
                        <span>Assignly</span>
                    </a>
                    
                            @php
                        $isLogin = request()->routeIs('login');
                        $isRegister = request()->routeIs('register');
                        $isPasswordRequest = request()->routeIs('password.request');
                        $isPasswordReset = request()->routeIs('password.reset');
                    @endphp

                    @unless ($isLogin || $isRegister || $isPasswordRequest || $isPasswordReset)
                        <ul class="nav-nav">
                            @if (Route::has('login'))
                                <li>
                                    <a href="{{ route('login') }}" class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}">
                                        Login
                                    </a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li>
                                    <a href="{{ route('register') }}" class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}">
                                        Register
                                    </a>
                                </li>
                            @endif
                        </ul>
                    @endunless
                    
                    <div class="nav-actions">
                        @if ($isLogin)
                            <a href="{{ route('register') }}" class="btn-nav btn-nav-primary">
                                Create Account
                            </a>
                        @elseif ($isRegister || $isPasswordRequest || $isPasswordReset)
                            <a href="{{ route('login') }}" class="btn-nav btn-nav-primary">
                                Sign In
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn-nav btn-nav-primary">
                                Get Started
                            </a>
                        @endif
                    </div>
                </div>
            </nav>
            
            <div class="nav-horizontal-main-content">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('warning'))
                    <div class="alert alert-warning" role="alert">
                        {{ session('warning') }}
                    </div>
                @endif
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @yield('content')
            </div>
        @endauth
    </div>
    
    <script>
        // Mobile navigation toggle
        const navMobileToggle = document.getElementById('navMobileToggle');
        const mainNav = document.getElementById('mainNav');
        
        if (navMobileToggle && mainNav) {
            navMobileToggle.addEventListener('click', function() {
                mainNav.classList.toggle('active');
            });
        }
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 768) {
                if (mainNav && !mainNav.contains(e.target) && !navMobileToggle.contains(e.target)) {
                    mainNav.classList.remove('active');
                }
            }
        });
        
        // Active nav link highlighting (additional safety)
        const currentPath = window.location.pathname;
        document.querySelectorAll('.nav-link').forEach(link => {
            const href = link.getAttribute('href');
            if (href && currentPath.includes(href.replace(/^\//, ''))) {
                link.classList.add('active');
            }
        });

        // Logout confirmation modal
        const logoutLink = document.getElementById('logoutLink');
        const logoutForm = document.getElementById('logout-form');
        const logoutModal = document.getElementById('logoutModal');
        const logoutModalClose = document.getElementById('logoutModalClose');
        const cancelLogout = document.getElementById('cancelLogout');
        const confirmLogout = document.getElementById('confirmLogout');

        const openLogoutModal = () => {
            logoutModal?.classList.add('active');
            logoutModal?.setAttribute('aria-hidden', 'false');
        };

        const closeLogoutModal = () => {
            logoutModal?.classList.remove('active');
            logoutModal?.setAttribute('aria-hidden', 'true');
        };

        if (logoutLink && logoutForm && logoutModal && cancelLogout && confirmLogout) {
            logoutLink.addEventListener('click', function(event) {
                event.preventDefault();
                openLogoutModal();
            });

            cancelLogout.addEventListener('click', function() {
                closeLogoutModal();
            });

            logoutModalClose.addEventListener('click', function() {
                closeLogoutModal();
            });

            logoutModal.addEventListener('click', function(event) {
                if (event.target === logoutModal) {
                    closeLogoutModal();
                }
            });

            confirmLogout.addEventListener('click', function() {
                logoutForm.submit();
            });
        }

        const deleteModal = document.getElementById('deleteConfirmModal');
        const deleteModalMessage = document.getElementById('deleteConfirmMessage');
        const deleteModalClose = document.getElementById('deleteConfirmModalClose');
        const cancelDelete = document.getElementById('cancelDelete');
        const confirmDelete = document.getElementById('confirmDelete');
        let pendingDeleteForm = null;

        const openDeleteModal = () => {
            deleteModal?.classList.add('active');
            deleteModal?.setAttribute('aria-hidden', 'false');
        };

        const closeDeleteModal = () => {
            deleteModal?.classList.remove('active');
            deleteModal?.setAttribute('aria-hidden', 'true');
            pendingDeleteForm = null;
        };

        document.querySelectorAll('form.delete-form .delete-button').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const form = this.closest('form.delete-form');
                const message = this.dataset.confirmMessage || 'Are you sure you want to delete this item?';
                pendingDeleteForm = form;
                if (deleteModalMessage) {
                    deleteModalMessage.textContent = message;
                }
                openDeleteModal();
            });
        });

        if (deleteModal && cancelDelete && confirmDelete && deleteModalClose) {
            cancelDelete.addEventListener('click', closeDeleteModal);
            deleteModalClose.addEventListener('click', closeDeleteModal);
            deleteModal.addEventListener('click', function(event) {
                if (event.target === deleteModal) {
                    closeDeleteModal();
                }
            });
            confirmDelete.addEventListener('click', function() {
                if (pendingDeleteForm) {
                    pendingDeleteForm.submit();
                }
                closeDeleteModal();
            });
        }
    </script>
    
    @yield('scripts')
</body>
</html>
