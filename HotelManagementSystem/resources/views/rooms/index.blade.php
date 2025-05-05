@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Our Rooms</h1>
    
    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('rooms.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-3">
                        <label>Room Type</label>
                        <select name="type" class="form-select">
                            <option value="">All Types</option>
                            <option value="standard" {{ request('type') === 'standard' ? 'selected' : '' }}>Standard</option>
                            <option value="deluxe" {{ request('type') === 'deluxe' ? 'selected' : '' }}>Deluxe</option>
                            <option value="suite" {{ request('type') === 'suite' ? 'selected' : '' }}>Suite</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Min Price</label>
                        <input type="number" name="min_price" class="form-control" value="{{ request('min_price') }}">
                    </div>
                    <div class="col-md-3">
                        <label>Max Price</label>
                        <input type="number" name="max_price" class="form-control" value="{{ request('max_price') }}">
                    </div>
                    <div class="col-md-3">
                        <label>Capacity</label>
                        <input type="number" name="capacity" class="form-control" value="{{ request('capacity') }}" min="1">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Apply Filters</button>
                <a href="{{ route('rooms.index') }}" class="btn btn-secondary mt-3">Reset</a>
            </form>
        </div>
    </div>
    
    <!-- Room Listing -->
    <div class="row">
        @foreach($rooms as $room)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($room->images->count() > 0)
                <img src="{{ asset('storage/' . $room->images->first()->image_path) }}" class="card-img-top" alt="{{ $room->title }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $room->title }}</h5>
                    <p class="card-text">
                        <strong>Type:</strong> {{ ucfirst($room->type) }}<br>
                        <strong>Price:</strong> ${{ number_format($room->price, 2) }} per night<br>
                        <strong>Capacity:</strong> {{ $room->capacity }} person(s)
                    </p>
                </div>
                <div class="card-footer bg-white">
                    <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    {{ $rooms->links() }}
</div>
@endsection