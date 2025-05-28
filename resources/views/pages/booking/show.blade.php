@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Boo            @extends('layouts.app')
            
            @section('content')
            <div class="container mt-5">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3>Bookings</h3>
                    <a href="{{ route('bookings.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> New Booking
                    </a>
                </div>
                <div class="card shadow">
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Bus</th>
                                    <th>Seat</th>
                                    <th>Booking Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->id }}</td>
                                    <td>{{ $booking->user->name ?? 'N/A' }}</td>
                                    <td>{{ $booking->bus->name ?? 'N/A' }}</td>
                                    <td>{{ $booking->seat_number }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->booking_time)->format('d M Y, H:i') }}</td>
                                    <td>
                                        <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-info btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Delete this booking?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No bookings found.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-3">
                    {{ $bookings->links() }}
                </div>
            </div>
            @endsection            @extends('layouts.app')
            
            @section('content')
            <div class="container mt-5">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4>New Booking</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('bookings.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="user_id" class="form-label">User</label>
                                <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                                    <option value="">Select User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id')==$user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="bus_id" class="form-label">Bus</label>
                                <select name="bus_id" id="bus_id" class="form-select @error('bus_id') is-invalid @enderror" required>
                                    <option value="">Select Bus</option>
                                    @foreach($buses as $bus)
                                        <option value="{{ $bus->id }}" {{ old('bus_id')==$bus->id ? 'selected' : '' }}>
                                            {{ $bus->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('bus_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="seat_number" class="form-label">Seat Number</label>
                                <input type="text" name="seat_number" id="seat_number" class="form-control @error('seat_number') is-invalid @enderror" value="{{ old('seat_number') }}" required>
                                @error('seat_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="booking_time" class="form-label">Booking Time</label>
                                <input type="datetime-local" name="booking_time" id="booking_time" class="form-control @error('booking_time') is-invalid @enderror" value="{{ old('booking_time') }}" required>
                                @error('booking_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <button class="btn btn-primary">Create Booking</button>
                            <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
            @endsectionking Details</h4>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Booking ID</dt>
                <dd class="col-sm-9">{{ $booking->id }}</dd>

                <dt class="col-sm-3">User</dt>
                <dd class="col-sm-9">{{ $booking->user->name ?? 'N/A' }}</dd>

                <dt class="col-sm-3">Bus</dt>
                <dd class="col-sm-9">{{ $booking->bus->name ?? 'N/A' }}</dd>

                <dt class="col-sm-3">Seat Number</dt>
                <dd class="col-sm-9">{{ $booking->seat_number }}</dd>

                <dt class="col-sm-3">Booking Time</dt>
                <dd class="col-sm-9">{{ \Carbon\Carbon::parse($booking->booking_time)->format('d M Y, H:i') }}</dd>

                <dt class="col-sm-3">Created At</dt>
                <dd class="col-sm-9">{{ $booking->created_at->format('d M Y, H:i') }}</dd>
            </dl>
            <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Back to List</a>
            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Are you sure you want to delete this booking?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection