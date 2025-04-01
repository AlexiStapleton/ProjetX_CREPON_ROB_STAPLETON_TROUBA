<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aime;

class AimeController extends Controller
{
    public function toggleLike(Request $request)
    {
        dd("bonjour");
        $user_id = $request->user_id;
        $post_id = $request->post_id;

        // Vérifier si l'utilisateur a déjà liké
        $like = Aime::where('idaimecompte', $user_id)
            ->where('idaimepost', $post_id)
            ->first();

        if ($like) {
            $like->delete(); // Supprimer le like
            $liked = false;
        } else {
            Aime::create([
                'idaimecompte' => $user_id,
                'idaimepost'   => $post_id
            ]);
            $liked = true;
        }

        // Récupérer le nouveau nombre de likes
        $likesCount = Aime::where('idaimepost', $post_id)->count();

        return response()->json([
            'liked'       => $liked,
            'likes_count' => $likesCount
        ]);
    }
}
