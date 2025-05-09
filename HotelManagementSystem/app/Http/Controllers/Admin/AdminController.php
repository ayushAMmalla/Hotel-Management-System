<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
{
    $totalRooms = Room::count();
    $totalBookings = Booking::count();
    $totalUsers = User::where('role', 'customer')->count(); // assuming 'role' field

    return view('admin.dashboard', compact('totalRooms', 'totalBookings', 'totalUsers'));
}
}
