<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Compte;
use App\Models\Post;
use App\Models\RT;
use Illuminate\Http\Request;

class RTController extends Controller
{
    public function toggle(Request $request){
        try{
            $validated = $request->validate([
                'post_id' => 'required|integer',
                'user_id' => 'required|integer'
            ]);

            $rt = Rt::where([
                'idrtcompte' => $validated['user_id'],
                'idrtpost' => $validated['post_id']
            ])->first();

            $test = '';

            if($rt){
                $rt->delete();
                $liked = false;
                $test = 'delete';
            }else{
                Rt::create([
                    'idrtcompte' => $validated['user_id'],
                    'idrtpost' => $validated['post_id'],
                    'datert' => date('d-m-Y')
                ]);
                $liked = true;
                $test = 'add';
            }

            $rtcount = Rt::where(['idrtcompte' => $validated['user_id'], 'idrtpost' => $validated['post_id']])->count();


            return response()->json([
                'success' => true,
                'test' => $test,
                'liked' => $liked,
                'rt_count' => $rtcount
            ], 200);

        }catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 500);
        }
    }
}
