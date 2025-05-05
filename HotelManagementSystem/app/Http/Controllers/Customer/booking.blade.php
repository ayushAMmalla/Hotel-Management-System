<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
        ]);

        $room = Room::findOrFail($validated['room_id']);

        // Check room availability
        $isAvailable = !Booking::where('room_id', $room->id)
            ->where(function ($query) use ($validated) {
                $query->whereBetween('check_in', [$validated['check_in'], $validated['check_out']])
                    ->orWhereBetween('check_out', [$validated['check_in'], $validated['check_out']])
                    ->orWhere(function ($query) use ($validated) {
                        $query->where('check_in', '<', $validated['check_in'])
                            ->where('check_out', '>', $validated['check_out']);
                    });
            })
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();

        if (!$isAvailable) {
            return back()->with('error', 'The room is not available for the selected dates.');
        }

        // Calculate total price
        $days = (new \DateTime($validated['check_in']))->diff(new \DateTime($validated['check_out']))->days;
        $totalPrice = $days * $room->price;

        // Create booking
        $booking = Booking::create([
            'user_id' => auth()->id(),
            'room_id' => $room->id,
            'check_in' => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'total_price' => $totalPrice,
            'status' => 'pending'
        ]);

        return redirect()->route('bookings.show', $booking)->with('success', 'Booking created successfully!');
    }
}
