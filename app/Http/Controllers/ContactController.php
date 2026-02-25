<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ContactMessage;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $start = (int) $request->input('_start_ts', 0);
        $elapsed = time() - $start;

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['nullable', 'string', 'max:40'],
            'company' => ['nullable', 'string', 'max:160'],
            'message' => ['required', 'string', 'min:20', 'max:5000'],
            // Honeypots
            'website' => ['prohibited'],
            '_start_ts' => ['nullable', 'integer'],
            '_token_check' => ['nullable', 'string', 'size:0'],
        ]);

        if ($elapsed < 3) {
            return back()->withInput()->withErrors(['message' => 'Please take a moment before submitting.']);
        }

        // Store the data
        \App\Models\Contact::create($validated);

        $to = config('company.email') ?: 'studio@example.com';

        Mail::to($to)->send(new ContactMessage(
            $validated['name'],
            $validated['email'],
            $validated['phone'] ?? null,
            $validated['company'] ?? null,
            $validated['message']
        ));

        return back()->with('status', 'Thanks for reaching out. We will reply within one business day.');
    }
}

