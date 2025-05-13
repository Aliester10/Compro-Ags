<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
// Uncomment if you want to create a mailable class later
// use App\Mail\SpecialistContactMail;

class SpecialistController extends Controller
{
    /**
     * Display the specialist contact form
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('member.profile.talk');
    }

    /**
     * Process the specialist contact form submission
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function message(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'company' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        // Here you would typically:
        // 1. Save the message to your database
        // 2. Send an email notification
        // 3. Perform any other business logic
        
        // Example: Store in database (uncomment and modify if you have a model for this)
        /*
        \App\Models\SpecialistMessage::create([
            'name' => $validated['fullName'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'company' => $validated['company'] ?? null,
            'message' => $validated['message'],
        ]);
        */
        
        // Example: Send email (uncomment and modify as needed)
        /*
        Mail::to('specialist@example.com')->send(
            new SpecialistContactMail($validated)
        );
        */
        
        // Redirect back with success message
        return redirect()->back()->with('success', 'Your message has been sent successfully! Our product specialist will contact you soon.');
    }
}