<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compte;

class CompteController extends Controller
{
    public function compte($id){
        $compte = Compte::where('idcompte', $id)->first();


        dd($compte);
        return view('compte')->with("compte", $compte);

    }
}
