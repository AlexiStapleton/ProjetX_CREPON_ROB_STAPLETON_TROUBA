<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Compte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ConnexionController extends Controller
{
    public function formulaire(){
        return view('connexion');
    }

    public function traitement(Request $request)
    {
        // Validation des données de la requête
        $validated = $request->validate([
            'login' => ['required'],
            'password' => ['required'],
        ]);

        // Extraction des données
        $login = $request->input('login');
        $password = $request->input('password');

        // Vérifier si l'utilisateur existe dans la base de données
        $user = Compte::where('logincompte', $login)->first();

        // Si l'utilisateur existe et que le mot de passe correspond
        if ($user && Hash::check($password, $user->mdpcompte)) {
            // Authentification réussie, connecter l'utilisateur
            Auth::login($user);

            // Rediriger l'utilisateur vers la page de son compte
            return redirect()->route('compte.show', ['id' => $user->idcompte])->with('success', 'Connexion réussie!');
        }

        // Si l'utilisateur n'existe pas ou si le mot de passe est incorrect
        return redirect()->route('connexion')->withErrors(['login' => 'Identifiants incorrects'])->withInput();
    }
}
