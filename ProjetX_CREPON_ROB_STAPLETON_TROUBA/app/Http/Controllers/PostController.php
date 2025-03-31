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

class PostController extends Controller
{
    public function post($id){
        $post = Post::where('idpost', $id)->with(['compte.photo','photos', 'likes', 'rt'])->first();



        return view('post')->with('post', $post);
    }
}
