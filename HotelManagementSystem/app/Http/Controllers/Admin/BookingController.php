<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('room')->latest()->paginate(10);

        return view('admin.bookings.index', compact('bookings'));
    }


    public function approve(Booking $booking)
    {
        $booking->status = 'confirmed';
        $booking->save();

        // Update room status
        $booking->room->status = 'occupied';
        $booking->room->save();

        $user = $booking->user;
        $action = 'approved';

        Mail::send('email.ApprovalEmail', [
            'booking' => $booking,
            'action' => $action
        ], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Your Booking Has Been Approved');
        });


        return back()->with('success', 'Booking approved successfully');
    }

    public function reject(Booking $booking)
    {
        $booking->status = 'cancelled';
        $booking->save();

        // Update room status
        $booking->room->status = 'available';
        $booking->room->save();

        $user = $booking->user;
        $action = 'rejected';

        Mail::send('email.ApprovalEmail', [
            'booking' => $booking,
            'action' => $action
        ], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Your Booking Has Been Cancelled');
        });

        return back()->with('success', 'Booking rejected successfully');
    }
}
