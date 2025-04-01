<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Compte;
use Illuminate\Http\Request;

class SignupController extends Controller
{
    public function formulaire(){
        return view('connexion');
    }

    public function signup(Request $request){
        $validate = $request->validate([
            'login' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            'nickname' => ['required', 'string', 'max:20'],
            'password_confirmation' => ['required', 'string', 'min:5', 'confirmed'],
        ]);

        $compte = Compte::where('logincompte', $validate->login )->first();

        if(!$compte){
            if($validate->password == $validate->password_confirmation){
                Compte::create([
                    'logincompte' => $validate->login,
                    'pseudocompte' => $validate->nickname,
                    'mdpcompte' => $validate->password,
                    'decriptioncompte'=> $validate->nickname,

                ]);
            }
        }
    }
}
