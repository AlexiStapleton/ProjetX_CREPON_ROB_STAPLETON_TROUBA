<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compte;
use App\Models\Post;
use App\Models\RT;
use App\Models\Citation;
use App\Models\Photo;
use App\Models\Aime;
use Carbon\Carbon;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function post($id){
        $post = Post::where('idpost', $id)->with(['compte.photo','photos', 'likes', 'rt'])->first();



        return view('post')->with('post', $post);
    }

    public function store(Request $request){


        // Validation
        $validated = $request->validate([
            'textpost' => 'required|max:280',
            'image' => 'nullable|image|max:2048'
        ]);

        Post::create([
            'textpost' => $request->textpost,
            'datepost' => now()->format('d/m/y'), // Ajoute la date
            'idcompte' => $request->input('user_id') // Valeur fixe ou supprime la colonne
        ]);

        return back()->with('success', 'Post créé !');
    }
}
