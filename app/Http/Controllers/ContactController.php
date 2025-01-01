<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        $details = [
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'message' => $request->message,
        ];

        Mail::send([], [], function ($message) use ($details) {
            $message->from('noreply@vscholar.in', 'VScholar Support')
                ->to('noreply@vscholar.in') // Sending to self for demonstration
                ->subject('New Contact Form Submission')
                ->setBody("
                    <p><strong>Name:</strong> {$details['name']}</p>
                    <p><strong>Email:</strong> {$details['email']}</p>
                    <p><strong>Contact:</strong> {$details['contact']}</p>
                    <p><strong>Message:</strong></p>
                    <p>{$details['message']}</p>
                ", 'text/html');
        });

        return response()->json(['success' => true, 'message' => 'Thank you for your message. We will get back to you soon!']);
    }
}

