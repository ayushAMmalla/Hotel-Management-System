@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Bookings</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Room</th>
                <th>Dates</th>
                <th>Total</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->user->name }}</td>
                <td>{{ $booking->room->name }}</td>
                <td>
                    {{ \Carbon\Carbon::parse($booking->check_in)->format('Y-m-d') }} to
                    {{ \Carbon\Carbon::parse($booking->check_out)->format('Y-m-d') }}
                </td>
                <td>${{ number_format($booking->total_price, 2) }}</td>
                <td>{{ ucfirst($booking->status) }}</td>
                <td>
                    @if($booking->status === 'pending')
                    <form action="{{ route('admin.bookings.approve', $booking) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success">Approve</button>
                    </form>
                    <form action="{{ route('admin.bookings.reject', $booking) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $bookings->links() }}
</div>
@endsection