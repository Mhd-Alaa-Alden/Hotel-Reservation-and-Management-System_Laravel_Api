<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required|string|max:255',
        ]);

        // Send email
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'messages' => $request->message,
        ];

        Mail::send('emails.contact', $data, function ($message) {
            $message->to('alaaalseyd4@gmail.com')->subject('New message from your website');
        });

        // Optionally, you can redirect the user after successful submission
        return response()->json(['message' => 'Successfully Send to Email ', 'submit' => $data], 200);
        // return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
