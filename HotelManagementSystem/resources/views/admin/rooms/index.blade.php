@extends('layouts.app')

@section('content')
    
<div class="container">
    <h1>Room Management</h1>
    <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary mb-3">Add New Room</a>
    
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rooms as $room)
                    <tr>
                        <td>{{ $room->id }}</td>
                        <td>{{ $room->title }}</td>
                        <td>{{ ucfirst($room->type) }}</td>
                        <td>${{ number_format($room->price, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $room->status === 'available' ? 'success' : ($room->status === 'occupied' ? 'danger' : 'warning') }}">
                                {{ ucfirst($room->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.rooms.edit', $room->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $rooms->links() }}
        </div>
    </div>
</div>
@endSection