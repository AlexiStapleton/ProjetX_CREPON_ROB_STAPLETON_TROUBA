<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aime;
use Illuminate\Support\Facades\Log;

class AimeController extends Controller
{
    public function toggle(Request $request)
    {
        try {
            $validated = $request->validate([
                'post_id' => 'required|integer',
                'user_id' => 'required|integer'
            ]);

            // Use the correct field names from your model
            $like = Aime::where([
                'idaimepost' => $validated['post_id'],
                'idaimecompte' => $validated['user_id']
            ])->first();

            if ($like) {
                $like->delete();
                $liked = false;
            } else {
                // Create with the correct field names
                Aime::create([
                    'idaimepost' => $validated['post_id'],
                    'idaimecompte' => $validated['user_id']
                ]);
                $liked = true;
            }

            // Count with the correct field name
            $likesCount = Aime::where('idaimepost', $validated['post_id'])->count();

            return response()->json([
                'success' => true,
                'liked' => $liked,
                'likes_count' => $likesCount
            ], 200);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 500);
        }
    }
}
