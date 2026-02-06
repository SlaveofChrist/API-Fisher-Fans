<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validation stricte des données
    $validated = $request->validate([
        'lastName'        => 'required|string|max:255',
        'firstName'       => 'required|string|max:255',
        'email'           => 'required|email|unique:users,email',
        'password'        => 'required|string|min:8', 
        'birthDate'       => 'required|date',
        'phoneNumber'     => 'required|string|max:255',
        'address'         => 'required|string|max:255',
        'postalCode'      => 'required|string|max:255',
        'city'            => 'required|string|max:255',
        'spokenLanguages' => 'nullable|array',
        'status'          => 'required|in:PARTICULIER,PROFESSIONNEL',
        'boatLicenseNumber' => 'nullable|string',
    ]);

    // 2. Création de l'utilisateur avec hachage du mot de passe
    $user = User::create([
        'lastName'        => $validated['lastName'],
        'firstName'       => $validated['firstName'],
        'email'           => $validated['email'],
        'password'        => Hash::make($validated['password']),
        'birthDate'       => $validated['birthDate'],
        'phoneNumber'     => $validated['phoneNumber'],
        'address'         => $validated['address'],
        'postalCode'      => $validated['postalCode'],
        'city'            => $validated['city'],
        'spokenLanguages' => $validated['spokenLanguages'] ?? [],
        'status'          => $validated['status'],
        "boatLicenseNumber" => $validated['boatLicenseNumber'] ?? ""
    ]);

    // 3. Initialisation des ressources liées (Carnet de pêche)
    // Comme défini dans ton modèle : chaque utilisateur a un FishingLog
    $user->fishingLog()->create();

    // 4. Retourner la réponse conforme au format OpenAPI (201 Created)
    return response()->json([
        'message' => 'Utilisateur créé avec succès',
        'user'    => $user
    ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        
        $validated = $request->validate([
            'lastName'        => 'sometimes|string|max:255',
            'firstName'       => 'sometimes|string|max:255',
            'email'           => 'sometimes|email|unique:users,email,' . $user->id,
            'birthDate'       => 'sometimes|date',
            'phoneNumber'     => 'sometimes|string',
            'address'         => 'sometimes|string',
            'postalCode'      => 'sometimes|string',
            'boatLicenseNumber' => 'sometimes|string',
            'city'            => 'sometimes|string',
            'status'          => 'sometimes|in:PARTICULIER,PROFESSIONNEL',
            'spokenLanguages' => 'nullable|array',
        ]);

        
        $user->update($validated);

        
        return response()->json([
            'message' => 'Utilisateur mis à jour avec succès.',
            'user'    => $user
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        
        $user->delete();

        return response()->json(null, 204);
    }
    /**
     * Display a listing of the boats for a specific user
     */
    public function listUserBoats(String $id){
        return User::find($id)->boats;
    }

    /**
     * Display a listing of the trips for a specific user
     */
    public function listUserTrips(String $id){
        return User::find($id)->trips;
    }

    /**
     * Display a listing of the bookings for a specific user
     */
    public function listUserBookings(String $id){
        return User::find($id)->bookings;
    }

}
