<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Booking;
use App\Models\Bus;
use App\Models\BusStop;
use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Book::with(['user', 'bus'])->latest()->paginate(10);
        return response()->json([
            'success' => true,
            'data' => $bookings
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // For API, usually not needed. For web, return a view if needed.
        return response()->json([
            'message' => 'Display booking creation form.'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'      => 'required|exists:users,id',
            'bus_id'       => 'required|exists:buses,id',
            'seat_number'  => 'required|string|max:10',
            'booking_time' => 'required|date|after_or_equal:now',
        ], [
            'user_id.required' => 'User is required.',
            'user_id.exists' => 'User does not exist.',
            'bus_id.required' => 'Bus is required.',
            'bus_id.exists' => 'Bus does not exist.',
            'seat_number.required' => 'Seat number is required.',
            'seat_number.max' => 'Seat number is too long.',
            'booking_time.required' => 'Booking time is required.',
            'booking_time.date' => 'Booking time must be a valid date.',
            'booking_time.after_or_equal' => 'Booking time must be now or in the future.',
        ]);

        // Check for seat double-booking
        $exists = Book::where('bus_id', $validated['bus_id'])
            ->where('seat_number', $validated['seat_number'])
            ->whereDate('booking_time', date('Y-m-d', strtotime($validated['booking_time'])))
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'This seat is already booked for the selected bus and time.'
            ], 422);
        }

        $booking = Book::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Booking created successfully.',
            'data' => $booking
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = Book::with(['user', 'bus'])->find($id);

        if (!$booking) {
            return response()->json([
                'success' => false,
                'message' => 'Booking not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $booking
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $booking = Book::with(['user', 'bus'])->find($id);

        if (!$booking) {
            return response()->json([
                'success' => false,
                'message' => 'Booking not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $booking
        ]);
    }


    public function booking_ticket()
    {

        $routes = Route::with(['startingStation', 'endingStation'])->get();
        $busStops = BusStop::all();
        $buses = Bus::all();

        return view('booking', compact('routes', 'busStops', 'buses'));
    }


    public function book_store(Request $request)
    {
        $request->validate([
            'route_id' => 'required|exists:routes,id',
            'bus_id' => 'required|exists:buses,id',
            'departure_time' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        Book::create([
            'user_id' => Auth::id(), // 👈 Capture the logged-in user's ID
            'route_id' => $request->route_id,
            'bus_id' => $request->bus_id,
            'departure_time' => $request->departure_time,
            'price' => $request->price,
            'status' => 'scheduled',
        ]);

        return redirect()->back()->with('success', 'Booking successful!');
    }

        public function my_history()
    {
        // Get the authenticated user's bookings with related route and bus data
        $bookings = Auth::user()->bookings()
            ->with(['route', 'bus'])
            ->orderBy('departure_time', 'desc')
            ->get();

        return view('my-bookings', compact('bookings'));
    }

    public function manage_bookings()
    {
        // Get all bookings with related user, route, and bus data
        $bookings = Book::with(['user', 'route', 'bus'])
            ->orderBy('departure_time', 'desc')
            ->paginate(10);
            

        return view('manage-bookings', compact('bookings'));
    }

}
