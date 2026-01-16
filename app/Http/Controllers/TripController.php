<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $trips = Trip::query()
            ->when($request->tripType, fn($q) => $q->where('tripType', $request->tripType))
            ->when($request->priceType, fn($q) => $q->where('priceType', $request->priceType))
            ->get();

        return response()->json($trips);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'practicalInformation' => 'required|string',
            'tripType' => 'required|in:JOURNALIERE,RECURRENTE',
            'priceType' => 'required|in:GLOBAL,PAR_PERSONNE',
            'startDates' => 'required|array',
            'endDates' => 'required|array',
            'departureTimes' => 'required|array',
            'endTimes' => 'required|array',
            'passengerCount' => 'required|integer|min:1',
            'price' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
            'boat_id' => 'required|exists:boats,idBoat',
        ]);

        $trip = Trip::create($validated);
        return response()->json($trip, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {
        return $trip;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $trip = Trip::findOrFail($id);
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric',
            'passengerCount' => 'sometimes|integer',
            // Ajoutez les autres champs selon vos besoins
        ]);

        $trip->update($validated);
        return response()->json($trip);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        $trip->delete();
        return response()->json(['message' => 'Voyage supprimé définitivement'], 204);
    }
}
