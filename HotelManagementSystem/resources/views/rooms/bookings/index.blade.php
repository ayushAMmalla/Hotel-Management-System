@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">My Bookings</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($bookings->isEmpty())
    <p>You have no bookings yet.</p>
    @else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Room</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->room->title ?? 'N/A' }}</td>
                <td>{{ \Carbon\Carbon::parse($booking->check_in)->format('d M Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($booking->check_out)->format('d M Y') }}</td>
                <td>Rs. {{ number_format($booking->total_price, 2) }}</td>
                <td>
                    <span>
                        {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                    </span>
                </td>
                <td>
                    @if(in_array($booking->status, ['pending', 'confirmed']))
                    <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">Request Cancel</button>
                    </form>
                    @else
                    <span class="text-muted">No action</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection