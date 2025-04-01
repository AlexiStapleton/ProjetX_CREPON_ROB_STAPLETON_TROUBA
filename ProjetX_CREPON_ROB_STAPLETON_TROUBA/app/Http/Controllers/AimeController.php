<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aime;

class AimeController extends Controller
{

    public function toggleLike(Request $request)
    {

        $user_id = $request->input('user_id');
        $post_id = $request->input('post_id');

        $check = Aime::where('idaimecompte', $user_id)
            ->where('idaimepost', $post_id)
            ->first();

        if ($check) {
            $check->delete();
        } else {
            Aime::create([
                'idaimecompte' => $user_id,
                'idaimepost'   => $post_id
            ]);
        }
        return back();
    }

}
