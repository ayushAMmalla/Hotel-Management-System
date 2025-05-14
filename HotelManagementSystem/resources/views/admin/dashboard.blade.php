@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Hotel Analytics Dashboard</h2>

    <div class="row g-4">
        <!-- Total Rooms Card -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-3 bg-gradient-primary">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-2">TOTAL ROOMS</h6>
                            <h2 class="text-white mb-0">{{ $totalRooms }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-20 p-3 rounded-circle">
                            <i class="fas fa-door-open fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Bookings Card -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-3 bg-gradient-success">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-2">TOTAL BOOKINGS</h6>
                            <h2 class="text-white mb-0">{{ $totalBookings }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-20 p-3 rounded-circle">
                            <i class="fas fa-calendar-check fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Customers Card -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-3 bg-gradient-info">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-2">TOTAL CUSTOMERS</h6>
                            <h2 class="text-white mb-0">{{ $totalUsers }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-20 p-3 rounded-circle">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</div>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #3f80ea 0%, #1e3c8b 100%);
    }

    .bg-gradient-success {
        background: linear-gradient(135deg, #00b09b 0%, #96c93d 100%);
    }

    .bg-gradient-info {
        background: linear-gradient(135deg, #4b6cb7 0%, #182848 100%);
    }

    .card {
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }
</style>

@endsection