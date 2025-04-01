<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Compte;
use App\Models\Post;
use App\Models\RT;
use Illuminate\Http\Request;

class RTController extends Controller
{
    public function toggleRt(Request $request){
        $idcompte = $request->input('user_id');
        $idpost = $request->input('post_id');

        $check = Rt::where('idrtcompte', $idcompte)
                ->where('idrtpost', $idpost)
                ->first();

        if($check){
            $check->delete();
        }else{
            RT::create([
                'datert' => now()->format('d-m-y'),
                'idrtcompte' => $idcompte,
                'idrtpost' => $idpost,
            ]);
        }
        return back();
    }
}
