@extends('layouts.app')
<style>
    .fixed-size-img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .card:hover .fixed-size-img {
        transform: scale(1.03);
    }
</style>
@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center fw-bold">Explore Our Rooms</h1>

    <!-- Filters -->
    <div class="card mb-5 shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('rooms.index') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Room Type</label>
                        <select name="type" class="form-select">
                            <option value="">All Types</option>
                            <option value="standard" {{ request('type') === 'standard' ? 'selected' : '' }}>Standard</option>
                            <option value="deluxe" {{ request('type') === 'deluxe' ? 'selected' : '' }}>Deluxe</option>
                            <option value="suite" {{ request('type') === 'suite' ? 'selected' : '' }}>Suite</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Min Price</label>
                        <input type="number" name="min_price" class="form-control" value="{{ request('min_price') }}" placeholder="e.g. 100">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Max Price</label>
                        <input type="number" name="max_price" class="form-control" value="{{ request('max_price') }}" placeholder="e.g. 500">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Capacity</label>
                        <input type="number" name="capacity" class="form-control" value="{{ request('capacity') }}" min="1" placeholder="e.g. 2">
                    </div>
                </div>
                <div class="mt-3 text-end">
                    <button type="submit" class="btn btn-primary me-2">Apply Filters</button>
                    <a href="{{ route('rooms.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Room Listing -->
        <h1 class="text-center mb-4">Available rooms</h1>
        <div class="container-fluid">
            <div class="row row-cols-2 row-cols-sm-1 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 g-3">
                @forelse($rooms as $room)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        @if($room->images->count() > 0)
                        <img src="{{ asset('storage/' . $room->images->first()->image_path) }}"
                            class="card-img-top rounded-top fixed-size-img"
                            alt="{{ $room->title }}">
                        @else
                        <img src="{{ asset('images/default-room.jpg') }}"
                            class="card-img-top rounded-top fixed-size-img"
                            alt="Default Room Image">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title fs-4">{{ $room->title }}</h5>
                            <p class="card-text text-muted">
                                <strong>Type:</strong> {{ ucfirst($room->type) }}<br>
                                <strong>Price:</strong> Rs. {{ number_format($room->price, 2) }} per night<br>
                                <strong>Capacity:</strong> {{ $room->capacity }} person(s)
                            </p>
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-outline-primary w-100">View Details</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        No rooms available matching your criteria.
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    <div class="mt-4 d-flex justify-content-center">
        {{ $rooms->links() }}
    </div>
</div>
@endsection