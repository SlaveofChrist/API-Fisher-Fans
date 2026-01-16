<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Create and register an user
     */
    public function register(Request $request){
        // Le validateur vérifie tout ce qui est dans $request (Body + Query)
    $validated = $request->validate([
        'firstName' => 'required|string|max:255',
        'lastName'  => 'required|string|max:255',
        'email'     => 'required|email|unique:users,email',
        'password'  => 'required|string|min:8|confirmed',
        'birthDate' => 'required|date',
        'phoneNumber'  => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'postalCode' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'status'    => 'nullable|string|in:PARTICULIER,PROFESSIONNEL',
    ]);

    // Création
    $user = User::create([
        'firstName' => $validated['firstName'],
        'lastName'  => $validated['lastName'],
        'email'     => $validated['email'],
        'password'  => Hash::make($validated['password']),
        'birthDate' => $validated['birthDate'],
        'phoneNumber'  => $validated['phoneNumber'],
        'address' => $validated['address'],
        'postalCode' => $validated['postalCode'],
        'city' => $validated['city'],
        'status'    => $validated['status'] ?? 'PARTICULIER',
    ]);

    // Initialisation automatique du carnet (One-to-One)
    $user->fishingLog()->create();

    $token = $user->createToken('api_token')->plainTextToken;

    return response()->json([
        'user' => $user,
        'token' => $token
    ], 201);
    }

    /**
     * Login an given user
     */
    public function login(Request $request){
        // 1. Validation des identifiants
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // 2. Chercher l'utilisateur par son email
    $user = User::where('email', $request->email)->first();
    
    // 3. Vérifier si l'utilisateur existe et si le mot de passe est correct
    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['Les identifiants fournis sont incorrects.'],
        ]);
    }

    // 4. Supprimer les anciens jetons (Optionnel, pour n'avoir qu'une session active)
    $user->tokens()->delete();

    // 5. Créer le nouveau jeton
    $token = $user->createToken('api_token')->plainTextToken;

    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer',
        'user' => $user
    ], 200);
    }
}
