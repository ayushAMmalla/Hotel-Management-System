<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Customer\RoomController as CustomerRoomController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

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
});



// ------------------------
// Customer Routes
// ------------------------
Route::middleware(['auth', 'role.auth:customer'])->group(function () {
    Route::get('/rooms', [CustomerRoomController::class, 'index'])->name('rooms.index');
    Route::get('/rooms/{room}', [CustomerRoomController::class, 'show'])->name('rooms.show');

    // Example: Room booking routes (if needed)
    // Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
});

require __DIR__ . '/auth.php';
