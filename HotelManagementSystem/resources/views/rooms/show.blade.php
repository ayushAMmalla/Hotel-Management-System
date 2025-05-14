@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            @if($room->images->count() > 0)
            <img src="{{ asset('storage/' . $room->images->first()->image_path) }}" class="img-fluid rounded" alt="{{ $room->title }}">
            @else
            <img src="{{ asset('images/default-room.jpg') }}" class="img-fluid rounded" alt="Default Room Image">
            @endif
        </div>
        <div class="col-md-6">
            <h2 class="fw-bold">{{ $room->title }}</h2>
            <p><strong>Type:</strong> {{ ucfirst($room->type) }}</p>
            <p><strong>Price:</strong> Rs. {{ number_format($room->price, 2) }} / night</p>
            <p><strong>Capacity:</strong> {{ $room->capacity }} person(s)</p>
            <p><strong>Description:</strong> {{ $room->description ?? 'No description available.' }}</p>

            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf
                <input type="hidden" name="room_id" value="{{ $room->id }}">

                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="mb-3">
                    <label for="check_in">Check-in Date:</label>
                    <input type="date" name="check_in" class="form-control"
                        min="{{ date('Y-m-d') }}" required>
                </div>
                <div class="mb-3">
                    <label for="check_out">Check-out Date:</label>
                    <input type="date" name="check_out" class="form-control"
                        min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Book Now</button>
            </form>
        </div>
    </div>
</div>
@endsection