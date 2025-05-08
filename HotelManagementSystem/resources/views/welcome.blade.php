<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HotelSewa</title>
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

        .fixed-size-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand fs-3 fw-bold me-4 {{ request()->routeIs('customer.home') ? 'active' : '' }}"
                href="{{ route('customer.home') }}">
                HotelSewa
            </a>


            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a href="{{ url('/rooms') }}" class="nav-link">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/contactUs') }}" class="nav-link">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/facilities') }}" class="nav-link">Facilities</a>
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



    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center text-white">
        <div class="container text-center py-5">
            <h1 class="display-4 fw-bold mb-4">Welcome to Hotel Sewa</h1>
            <p class="lead mb-5 mx-auto" style="max-width: 700px;">
                Book your stay and enjoy Luxury
                redefined at the most affordable rates.
            </p>
            <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                @auth
                @if(auth()->user()->isCustomer())
                <a href="{{ url('/booking') }}" class="btn btn-warning px-3 py-3">
                    Book Now
                </a>
                @endif
                @else
                <a href="{{ route('register') }}" class="btn btn-warning px-3 py-3">
                    Book Now
                </a>
                @endauth
            </div>
        </div>
    </section>

    <section id="rooms" class="bg-white py-4">
        <h1 class="text-center">Our Rooms</h1>        
        <div class="container-fluid">
            <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4">
                @forelse($rooms as $room)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        @if($room->images->count() > 0)
                        <img src="{{ asset('storage/' . $room->images->first()->image_path) }}"
                            class="card-img-top fixed-size-img"
                            alt="{{ $room->title }}">
                        @else
                        <img src="{{ asset('images/default-room.jpg') }}"
                            class="card-img-top fixed-size-img"
                            alt="Default Room Image">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $room->title }}</h5>
                            <p class="card-text">
                                <strong>Type:</strong> {{ ucfirst($room->type) }}<br>
                                <strong>Price:</strong> Rs. {{ number_format($room->price, 2) }} per night<br>
                                <strong>Capacity:</strong> {{ $room->capacity }} person(s)
                            </p>
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-outline-primary w-100">View Details</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col">
                    <div class="alert alert-warning w-100 text-center">
                        No rooms available at the moment.
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-secondary text-white mt-2 ">
        <div class="container py-2">
            <div class="row g-4">
                <div class="col-lg-3">
                    <h3 class="h4 fw-bold mb-4">HotelSewa</h3>
                    <p class="text-muted">
                        Comprehensive hotel management solution for properties of all sizes.
                    </p>
                </div>
                <div class="col-lg-3">
                    <h4 class="h5 fw-bold mb-4">Product</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover:text-white">Features</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover:text-white">Pricing</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover:text-white">Integrations</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover:text-white">Updates</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h4 class="h5 fw-bold mb-4">Resources</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover:text-white">Documentation</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover:text-white">Guides</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover:text-white">Blog</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover:text-white">Support</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h4 class="h5 fw-bold mb-4">Company</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover:text-white">About</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover:text-white">Careers</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover:text-white">Contact</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover:text-white">Legal</a></li>
                    </ul>
                </div>
            </div>

            <hr class="border-dark">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <p class="text-muted mb-3 mb-md-0">© 2023 HotelSewa. All rights reserved.</p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-muted hover:text-white fs-5">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-muted hover:text-white fs-5">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-muted hover:text-white fs-5">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="text-muted hover:text-white fs-5">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>