<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $query = Room::with('images')->where('status', 'available');

        // Apply filters
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->has('capacity')) {
            $query->where('capacity', '>=', $request->capacity);
        }

        $rooms = $query->paginate(9);

        return view('rooms.index', compact('rooms'));
    }

    public function showRooms()
    {
        $rooms = Room::with('images')->where('status', 'available')->get(); // Only show available rooms
        return view('welcome', compact('rooms'));
    }
    public function show($id)
    {
        $room = Room::with('images')->findOrFail($id);
        return view('rooms.show', compact('room'));
    }
}
