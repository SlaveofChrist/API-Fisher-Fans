<?php

namespace App\Http\Controllers;

use App\Models\Boat;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BoatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       $boats = Boat::query()
        // Filtre sur la capacité (si présent)
        ->when($request->maxCapacity, function ($query, $maxCapacity) {
            $query->where('maxCapacity', $maxCapacity);
        })
        // Filtre sur le type de permis
        ->when($request->permitType, function ($query, $permitType) {
            $query->where('permitType', $permitType);
        })->get();

        return response()->json($boats);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'brand' => 'required|string|max:255',
        'manufacturingYear' => 'required|integer|min:1900|max:' . date('Y'),
        'homePort' => 'required|string|max:255',
        'permitType' => 'required|in:COTIER,FLUVIAL',
        'boatType' => 'required|in:OPEN,CABINE,CATAMARAN,VOILIER,JETSKI,CANOE',
        'engineType' => 'required|in:DIESEL,ESSENCE,AUCUN',
        'enginePower' => 'required|numeric',
        'depositAmount' => 'required|numeric',
        'maxCapacity' => 'required|integer',
        'numberOfBeds' => 'required|integer',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'equipments' => 'nullable|array|in:SONDEUR,VIVIER,ECHELLE,GPS,PORTECANNES,RADIO_VHF',
        'user_id' => 'required|exists:users,id',
    ]);

    $boat = Boat::create($validated);

    return response()->json([
        'message' => 'Bateau créé avec succès',
        'data' => $boat
    ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Boat $boat)
    {
        return $boat;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // On cherche par la clé primaire personnalisée idBoat
        $boat = Boat::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'depositAmount' => 'sometimes|numeric',
            'latitude' => 'sometimes|numeric',
            'longitude' => 'sometimes|numeric',
            'equipments' => 'sometimes|array',
        ]);

        $boat->update($validated);

        return response()->json([
            'message' => 'Bateau mis à jour avec succès',
            'data' => $boat
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Boat $boat)
    {
       
        $boat->delete();

        return response()->json([
            'message' => 'Bateau supprimé définitivement'
        ], 204);
    }
}
