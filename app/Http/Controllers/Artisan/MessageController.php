<?php

namespace App\Http\Controllers\Artisan;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Controllers\Controller;
use App\Mail\MessageSent;

class MessageController extends Controller
{
    public function index() 
    {
        return Inertia::render('artisan/messages/Index',[
                'messages' => Auth::user()->artisan->messages()->get(),
            ],
        );
    }

    public function store(Request $request)
    {
        $attrs = $request->validate([
            'sender_email' => 'required|string',
            'sender_name' => 'required|string',
            'sent_at' => 'required|date',
            'content' => 'required|string',
        ]);

        $sanitizedContent = strip_tags($attrs['content'], '<p><br><strong><em><u><ul><li>');
        $request->user()->artisan->messages()->create([
            'sender_email' => $attrs['sender_email'],
            'sender_name' => $attrs['sender_name'],
            'content' => $sanitizedContent,
            'sent_at' => Carbon::parse($attrs['sent_at']),
        ]);

        Mail::to($request->user())->send(new MessageSent($attrs['sender_name']));

        return back()->with('success', __('Artisan profile successfully updated.'));
    }
}