@extends('layouts.app')

@section('content')


@if(auth()->user()->isCustomer())
<div class="alert alert-success mb-4">
    This is the best ever
</div>
@endif

<div class="py-5">
    <div class="container">
        <div class="card shadow-sm">
            <section id="features" class="py-20 bg-white">
                <div class="container mx-auto px-4">
                    <h2 class="text-3xl font-bold text-center mb-4">Our Features</h2>
                    <p class="text-xl text-gray-600 text-center mb-12 max-w-2xl mx-auto">Everything you need to manage your hotel efficiently</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <!-- Feature 1 -->
                        <div class="feature-card bg-gray-50 p-8 rounded-lg shadow-md">
                            <div class="text-indigo-600 text-4xl mb-4">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <h3 class="text-xl font-bold mb-3">Reservation Management</h3>
                            <p class="text-gray-600">Easily manage bookings, check-ins, and check-outs with our intuitive interface.</p>
                        </div>

                        <!-- Feature 2 -->
                        <div class="feature-card bg-gray-50 p-8 rounded-lg shadow-md">
                            <div class="text-indigo-600 text-4xl mb-4">
                                <i class="fas fa-concierge-bell"></i>
                            </div>
                            <h3 class="text-xl font-bold mb-3">Housekeeping</h3>
                            <p class="text-gray-600">Track room status, assign tasks, and ensure perfect cleanliness standards.</p>
                        </div>

                        <!-- Feature 3 -->
                        <div class="feature-card bg-gray-50 p-8 rounded-lg shadow-md">
                            <div class="text-indigo-600 text-4xl mb-4">
                                <i class="fas fa-receipt"></i>
                            </div>
                            <h3 class="text-xl font-bold mb-3">Billing & Invoicing</h3>
                            <p class="text-gray-600">Generate invoices, process payments, and manage financial records seamlessly.</p>
                        </div>

                        <!-- Feature 4 -->
                        <div class="feature-card bg-gray-50 p-8 rounded-lg shadow-md">
                            <div class="text-indigo-600 text-4xl mb-4">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h3 class="text-xl font-bold mb-3">Analytics Dashboard</h3>
                            <p class="text-gray-600">Get insights into occupancy rates, revenue, and other key performance metrics.</p>
                        </div>

                        <!-- Feature 5 -->
                        <div class="feature-card bg-gray-50 p-8 rounded-lg shadow-md">
                            <div class="text-indigo-600 text-4xl mb-4">
                                <i class="fas fa-users"></i>
                            </div>
                            <h3 class="text-xl font-bold mb-3">Staff Management</h3>
                            <p class="text-gray-600">Manage employee schedules, roles, and permissions with ease.</p>
                        </div>

                        <!-- Feature 6 -->
                        <div class="feature-card bg-gray-50 p-8 rounded-lg shadow-md">
                            <div class="text-indigo-600 text-4xl mb-4">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <h3 class="text-xl font-bold mb-3">Mobile Friendly</h3>
                            <p class="text-gray-600">Access the system from any device, anywhere, at any time.</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection