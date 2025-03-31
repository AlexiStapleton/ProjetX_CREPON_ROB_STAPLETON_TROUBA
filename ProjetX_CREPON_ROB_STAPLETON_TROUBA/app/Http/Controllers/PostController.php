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
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function post($id){
        $post = Post::where('idpost', $id)->with(['compte.photo','photos', 'likes', 'rt'])->first();



        return view('post')->with('post', $post);
    }

    public function store(Request $request){

        $request->validate([
            'textpost' => 'required|string|max:280',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        DB::beginTransaction();
        try {
            $post = Post::create([
                'idcompte' => auth()->id(),
                'textpost' => $request->textpost,
            ]);
            if($request->hasFile('image')){
                $imagePath = $request->file('image')->store('photos', 'public');
                $photo = Photo::create([
                    'urlphoto' => $imagePath,
                ]);
                DB::table('a_pour_photo')->insert([
                    'idpost' => $post->idpost,
                    'idphoto' => $photo->idphoto,
                ]);
            }
            DB::commit();

        }catch (\Exception $exception){
            DB::rollBack();
        }
    }
}
