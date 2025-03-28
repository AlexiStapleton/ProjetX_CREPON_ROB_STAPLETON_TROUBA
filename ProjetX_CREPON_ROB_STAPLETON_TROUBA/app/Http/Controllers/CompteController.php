<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compte;
use App\Models\Post;
use App\Models\RT;
use App\Models\Citation;

class CompteController extends Controller
{
    public function compte($id){
        $compte = Compte::where('idcompte', $id)->first();
        $posts = Post::where('idcompte', $id)
            ->orderByRaw("TO_DATE(datepost, 'DD/MM/YYYY')")
            ->get();
        $rts = RT::where('idrtcompte', $id)
            ->orderByRaw("TO_DATE(datert, 'DD/MM/YYYY')")
            ->get();
        $citations = Citation::whereHas('postCitation', function($query) use ($id) {
            $query->where('idcompte', $id);
        })->get();


        dd($citations);
        dd($rts);
        dd($posts);
        dd($compte);
        return view('compte')->with("compte", $compte);

    }
}
