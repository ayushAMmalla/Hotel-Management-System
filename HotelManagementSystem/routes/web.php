<?php

use App\Http\Controllers\Admin\AdminController as AdminAdminController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Customer\BookingController as CustomerBookingController;
use App\Http\Controllers\Customer\CustomerController as CustomerCustomerController;
use App\Http\Controllers\Customer\RoomController as CustomerRoomController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;

Route::get('/', [CustomerRoomController::class, 'showRooms'])->name('customer.home');


// Admin-specific routes
Route::middleware(['auth', 'role.auth:admin'])->group(function () {
    Route::get('dashboard', [AdminAdminController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/rooms/availability', [AdminRoomController::class, 'apiAvailability']);

Route::get('/calendar', [AdminRoomController::class, 'calendarView']);

// ------------------------
// Admin Routes
// ------------------------
Route::middleware(['auth', 'role.auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('rooms', AdminRoomController::class);
    Route::delete('room-images/{image}', [AdminRoomController::class, 'destroyImage'])->name('room-images.destroy');

    


    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings/{booking}/approve', [AdminBookingController::class, 'approve'])->name('bookings.approve');
    Route::post('/bookings/{booking}/reject', [AdminBookingController::class, 'reject'])->name('bookings.reject');

});



// ------------------------
// Customer Routes
// ------------------------
Route::middleware(['auth', 'role.auth:customer'])->group(function () {
    Route::get('/rooms', [CustomerRoomController::class, 'index'])->name('rooms.index');
    Route::get('/rooms/{room}', [CustomerRoomController::class, 'show'])->name('rooms.show');
    Route::get('/bookings/{booking}', [CustomerBookingController::class, 'show'])->name('bookings.show');
    Route::post('/bookings', [CustomerBookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings', [CustomerBookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings/{booking}/cancel', [CustomerBookingController::class, 'cancelRequest'])->name('bookings.cancel');

    Route::get('/contactUs', [CustomerCustomerController::class, 'contactUs'])->name('contactUs');
});

require __DIR__ . '/auth.php';
