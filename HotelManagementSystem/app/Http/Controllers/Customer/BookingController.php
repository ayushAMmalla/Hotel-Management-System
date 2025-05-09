<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('user_id', auth()->id())
            ->orderBy('check_in', 'desc')
            ->get();

        return view('rooms.bookings.index', compact('bookings'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
        ]);

        $room = Room::findOrFail($validated['room_id']);

        // Check availability
        $isAvailable = !Booking::where('room_id', $room->id)
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($validated) {
                $query->whereBetween('check_in', [$validated['check_in'], $validated['check_out']])
                    ->orWhereBetween('check_out', [$validated['check_in'], $validated['check_out']])
                    ->orWhere(function ($query) use ($validated) {
                        $query->where('check_in', '<=', $validated['check_in'])
                            ->where('check_out', '>=', $validated['check_out']);
                    });
            })
            ->exists();

        if (!$isAvailable) {
            return back()->with('error', 'Room is not available for the selected dates');
        }

        $checkIn = Carbon::parse($validated['check_in']);
        $checkOut = Carbon::parse($validated['check_out']);
        $totalDays = $checkIn->diffInDays($checkOut);
        $totalPrice = $totalDays * $room->price;

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'room_id' => $room->id,
            'check_in' => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'total_price' => $totalPrice,
            'status' => 'pending'
        ]);

        // Update room status to occupied
        $room->status = 'occupied';
        $room->save();

        return redirect()->route('bookings.show', $booking->id)
            ->with('success', 'Booking created successfully!');
    }



    public function show(Booking $booking)
    {
        // Ensure the user owns the booking
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }

        return view('rooms.bookings.show', compact('booking'));
    }

    public function cancelRequest(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }

        if ($booking->status === 'pending' || $booking->status === 'confirmed') {
            $booking->status = 'cancelled';
            $booking->save();


            $room = Room::findOrFail($booking->room_id);
            $room->status = 'available';
            $room->save();


            return redirect()->route('bookings.index')->with('success', 'Cancellation request sent.');
        }

        return back()->with('error', 'Cannot cancel this booking.');
    }
}
