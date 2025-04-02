<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class GrokController extends Controller
{
    public function index()
    {
        return view('groke');
    }

    public function ask(Request $request)
    {
        if (!auth()->check()) {
            return redirect('/');
        }
        $request->validate([
            'message' => 'required|string',
        ]);

        $response = OpenAI::chat()->create([
            'model' => 'gpt-4o-mini',
            'messages' => [
                ['role' => 'user', 'content' => $request->input('message')],
            ],
        ]);

        return view('groke', [
            'message' => $request->input('message'),
            'response' => $response->choices[0]->message->content,
        ]);
    }
}
