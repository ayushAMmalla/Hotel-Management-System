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
                            <span class="text-white-50 small">Available: {{ $availableRooms ?? 0 }}</span>
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
                            <span class="text-white-50 small">This month: {{ $monthlyBookings ?? 0 }}</span>
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
                            <span class="text-white-50 small">New today: {{ $newUsersToday ?? 0 }}</span>
                        </div>
                        <div class="bg-white bg-opacity-20 p-3 rounded-circle">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Stats Row -->
    <div class="row mt-4 g-4">
        <!-- Occupancy Rate -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">OCCUPANCY RATE</h6>
                            <h2 class="text-primary mb-0">{{ $occupancyRate ?? 0 }}%</h2>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-bed fa-2x "></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="progress" style="height: 6px;">
                            <!-- <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $occupancyRate ?? 0 }}%"  -->
                            <div class="progress-bar bg-primary" role="progressbar"
                                aria-valuenow="{{ $occupancyRate ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">TODAY'S REVENUE</h6>
                            <h2 class="text-success mb-0">${{ number_format($todayRevenue ?? 0, 2) }}</h2>
                        </div>
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-dollar-sign fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Average Stay -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">AVG. STAY DURATION</h6>
                            <h2 class="text-warning mb-0">{{ $avgStayDuration ?? 0 }} days</h2>
                        </div>
                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-clock fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Room Types -->
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-3 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">ROOM TYPES</h6>
                            <h2 class="text-info mb-0">{{ $standardRooms ?? 0 }} / {{ $deluxeRooms ?? 0 }}</h2>
                            <span class="text-muted small">Standard / Deluxe</span>
                        </div>
                        <div class="bg-info bg-opacity-10 p-3 rounded-circle">
                            <i class="fas fa-star fa-2x text-info"></i>
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