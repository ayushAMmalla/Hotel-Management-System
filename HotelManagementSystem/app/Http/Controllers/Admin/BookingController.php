<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function cancel(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        $booking->update(['status' => 'cancel_requested']);
        return back()->with('success', 'Cancellation requested');
    }

    // Admin method
    public function approveCancel(Booking $booking)
    {
        $booking->update(['status' => 'canceled']);
        return back()->with('success', 'Booking canceled');
    }
}
