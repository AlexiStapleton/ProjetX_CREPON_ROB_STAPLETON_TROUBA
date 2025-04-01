<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aime;

class AimeController extends Controller
{
    public function toggleLike(Request $request){
        dd("oui");
        $idcompte = $request->input("user_id");
        $idpost = $request->input("post_id");

        $check = Aime::where("user_id", $idcompte)->where("post_id", $idpost)->first();

        if($check){
            $check->delete();
        }
        else{
            Aime::create([
                'idaimecompte' => $idcompte,
                'idaimecompte' => $idpost
            ]);
        }
    }
}
