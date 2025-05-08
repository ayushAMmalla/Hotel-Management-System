<?php

use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Customer\BookingController as CustomerBookingController;
use App\Http\Controllers\Customer\RoomController as CustomerRoomController;
use App\Http\Controllers\ProfileController;

Route::get('/', [CustomerRoomController::class, 'showRooms'])->name('customer.home');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ------------------------
// Admin Routes
// ------------------------
Route::middleware(['auth', 'role.auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('rooms', AdminRoomController::class);
    Route::delete('room-images/{image}', [AdminRoomController::class, 'destroyImage'])->name('room-images.destroy');

    Route::get('/admin/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index');
    Route::put('/admin/bookings/{booking}/approve', [AdminBookingController::class, 'approve'])->name('admin.bookings.approve');
    Route::put('/admin/bookings/{booking}/reject', [AdminBookingController::class, 'reject'])->name('admin.bookings.reject');


});



// ------------------------
// Customer Routes
// ------------------------
Route::middleware(['auth', 'role.auth:customer'])->group(function () {
    Route::get('/rooms', [CustomerRoomController::class, 'index'])->name('rooms.index');
    Route::get('/rooms/{room}', [CustomerRoomController::class, 'show'])->name('rooms.show');
    Route::get('/bookings/{booking}', [CustomerBookingController::class, 'show'])->name('bookings.show');
    Route::post('/bookings', [CustomerBookingController::class, 'store'])->name('bookings.store');

});

require __DIR__ . '/auth.php';
