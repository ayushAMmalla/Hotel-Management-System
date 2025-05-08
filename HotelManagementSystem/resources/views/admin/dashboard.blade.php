<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HotelSewa - Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1551882547-ff40c63fe5fa');
            background-size: cover;
            background-position: center;
            min-height: 70vh;
        }

        .feature-card {
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .popular-plan {
            border: 2px solid #0d6efd;
            position: relative;
        }

        .popular-badge {
            position: absolute;
            top: 0;
            right: 0;
            background: #0d6efd;
            color: white;
            padding: 5px 15px;
            font-size: 0.8rem;
            border-bottom-left-radius: 5px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand fs-3 fw-bold me-4" href="#">HotelSewa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.rooms.index') }}">View Room</a>
                    </li>
                </ul>

                <!-- Right Side of Navbar -->
                <ul class="navbar-nav ms-auto">
                    @if (Route::has('login'))
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link btn btn-warning mx-1 px-4 py-1">Log in</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link btn btn-warning mx-1 px-4 py-1">Register</a>
                    </li>
                    @endif
                    @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Features Section -->
    <section id="features" class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">Powerful Features</h2>
                <p class="lead text-muted mx-auto" style="max-width: 600px;">
                    Everything you need to manage your hotel efficiently
                </p>
            </div>

            <div class="row g-4">
                <!-- Feature 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card bg-light p-4 h-100 rounded-3">
                        <div class="text-primary mb-3 fs-1">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <h3 class="h4 fw-bold mb-3">Reservation Management</h3>
                        <p class="text-muted">
                            Easily manage bookings, check-ins, and check-outs with our intuitive interface.
                        </p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card bg-light p-4 h-100 rounded-3">
                        <div class="text-primary mb-3 fs-1">
                            <i class="fas fa-concierge-bell"></i>
                        </div>
                        <h3 class="h4 fw-bold mb-3">Housekeeping</h3>
                        <p class="text-muted">
                            Track room status, assign tasks, and ensure perfect cleanliness standards.
                        </p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card bg-light p-4 h-100 rounded-3">
                        <div class="text-primary mb-3 fs-1">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <h3 class="h4 fw-bold mb-3">Billing & Invoicing</h3>
                        <p class="text-muted">
                            Generate invoices, process payments, and manage financial records seamlessly.
                        </p>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card bg-light p-4 h-100 rounded-3">
                        <div class="text-primary mb-3 fs-1">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="h4 fw-bold mb-3">Analytics Dashboard</h3>
                        <p class="text-muted">
                            Get insights into occupancy rates, revenue, and other key performance metrics.
                        </p>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card bg-light p-4 h-100 rounded-3">
                        <div class="text-primary mb-3 fs-1">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="h4 fw-bold mb-3">Staff Management</h3>
                        <p class="text-muted">
                            Manage employee schedules, roles, and permissions with ease.
                        </p>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card bg-light p-4 h-100 rounded-3">
                        <div class="text-primary mb-3 fs-1">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h3 class="h4 fw-bold mb-3">Mobile Friendly</h3>
                        <p class="text-muted">
                            Access the system from any device, anywhere, at any time.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>