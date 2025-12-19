<?php

namespace App\Http\Controllers;

use App\Models\FishingLog;
use App\Models\FishingLogPage;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class FishingLogPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $idUser)
    {
        $idFishingLog = User::find($idUser)->fishingLog->idFishingLog;
        return FishingLog::find($idFishingLog)->pages;
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $idUser, string $idFishingLogPage)
    {
        $validated = $request->validate([
            'sizeCm'        => 'sometimes|decimal',
            'weightKg'       => 'sometimes|decimal',
            'fishingLocation'     => 'sometimes|string',
            'fishingDate'       => 'sometimes|date',
            'released'         => 'sometimes|boolean',
            'photoUrl' => 'sometimes|string',
            'comment' => 'sometimes|string|max:10000',
        ]);

       // $validated['comment'];

        $idFishingLog = User::find($idUser)->fishingLog->idFishingLog;
        $fishingLogPage = FishingLog::find($idFishingLog)->pages
        ->where('idFishingLogPage',$idFishingLogPage)
        ->first();
    
        $fishingLogPage->update($validated);
        
        
        return response()->json([
            'message' => 'Page de carnet de pêche mise à jour avec succès.',
            'fishingLogPage'    => $fishingLogPage
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $idUser,string $idFishingLogPage)
    {
        $idFishingLog = User::find($idUser)->fishingLog->idFishingLog;
        $fishingLogPage = FishingLog::find($idFishingLog)->pages
        ->where('idFishingLogPage',$idFishingLogPage)
        ->first();

        $fishingLogPage->delete();

        return response()->json(null, 204);
    }
}
