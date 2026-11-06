<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:150',
        ]);

        Newsletter::firstOrCreate([
            'email' => strtolower(trim($validated['email']))
        ]);

        return back()->with('newsletter_success', 'Cheers! You are subscribed to our Tuesday front-end dispatch. Zero tracking, pure craft.');
    }
}
