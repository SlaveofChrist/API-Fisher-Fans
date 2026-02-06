<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $bookings = Booking::query()
            ->when($request->numberOfSeats, fn($q) => $q->where('numberOfSeats', $request->numberOfSeats))
            ->when($request->dateOfBooking, fn($q) => $q->whereDate('date', $request->dateOfBooking))
            ->get();

        return response()->json($bookings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'dateBooking' => 'required|date',
            'numberOfSeats' => 'required|integer|min:1',
            'totalPrice' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
            'trip_id' => 'required|exists:trips,idTrip',
        ]);

        $booking = Booking::create($validated);
        return response()->json($booking, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        return $booking;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $booking = Booking::findOrFail($id);
        $validated = $request->validate([
            'numberOfSeats' => 'sometimes|integer|min:1',
            'totalPrice' => 'sometimes|numeric',
        ]);

        $booking->update($validated);
        return response()->json($booking,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return response()->json(['message' => 'Reservation supprimé définitivement'], 204);
    }
}
