<?php

namespace App\Http\Controllers;
use Inertia\Inertia;

use Illuminate\Http\Request;
use Orhanerday\OpenAi\OpenAi;

class OpenAiController extends Controller
{
    public function index() {
      return Inertia::render('HomePage');
    }

    public function openai(Request $request)
    {
        $question = $request->question;
        $open_ai_key = env('OPENAI_API_KEY');
        $open_ai = new OpenAi($open_ai_key);
        $complete = $open_ai->completion([
            'model' => 'text-davinci-003',
            'prompt' => $question,
            'temperature' => 0.9,
            'max_tokens' => 1000,
            'frequency_penalty' => 0,
            'presence_penalty' => 0.6,
        ]);

        return json_decode($complete);
    }
}
