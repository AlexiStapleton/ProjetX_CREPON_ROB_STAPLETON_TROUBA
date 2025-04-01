<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Compte;
use Illuminate\Http\Request;

class ConnexionController extends Controller
{
    public function formulaire(){
        return view('connexion');
    }

    public function traitement(){

        request()->validate([
            'login' => ['required'],
            'password' => ['required'],
        ]);

        $compte = Compte::where('logincompte', request('login'))->first();

        if($compte->mdpcompte == request('password')){
            dd($compte);
            return 'Traitement formulaire connexion';
        }


    }
}
