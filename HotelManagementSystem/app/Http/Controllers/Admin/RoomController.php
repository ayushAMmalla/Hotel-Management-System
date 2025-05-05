<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('images')->paginate(10);
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:standard,deluxe,suite',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:available,occupied,maintenance',
            'description' => 'required|string',
        ]);

        $room = Room::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('room_images', 'public');
                RoomImage::create([
                    'room_id' => $room->id,
                    'image_path' => $path
                ]);
            }
        }

        return redirect()->route('admin.rooms.index')->with('success', 'Room created successfully');
    }

    public function edit(Room $room)
    {
        $room->load('images');
        return view('admin.rooms.edit', compact('room'));
    }

    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'price' => 'required|numeric',
            'capacity' => 'required|numeric',
            'status' => 'required|string|max:255',
            'description' => 'required|string',
            'images.*' => 'nullable|image|max:2048', // Ensure images are validated
        ]);

        // Update room data
        $room->update($request->except('images')); // Exclude 'images' from the update query

        // Handle image uploads if any
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $imagePath = $imageFile->store('room_images', 'public');
                $room->images()->create([
                    'image_path' => $imagePath,
                ]);
            }
        }

        // Handle image deletions
        if ($request->has('deleted_images')) {
            foreach ($request->input('deleted_images') as $imageId) {
                $image = RoomImage::findOrFail($imageId);
                Storage::disk('public')->delete($image->image_path); // Delete the image file
                $image->delete(); // Delete the image record from database
            }
        }

        return redirect()->route('admin.rooms.index')->with('success', 'Room updated successfully');
    }


    public function destroyImage(RoomImage $image)
    {
        // Delete file from storage
        Storage::delete('public/' . $image->image_path);

        // Delete record from database
        $image->delete();

        return back()->with('success', 'Image deleted successfully');
    }
    public function destroy($id)
    {
        $room = Room::findOrFail($id);

        // Optional: Delete associated images or other resources
        // foreach ($room->images as $image) {
        //     Storage::delete($image->path);
        //     $image->delete();
        // }

        $room->delete();

        return redirect()->route('admin.rooms.index')->with('success', 'Room deleted successfully.');
    }
}
