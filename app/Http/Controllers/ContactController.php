<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required','string','max:100'],
            'last_name' => ['nullable','string','max:100'],
            'email' => ['required','email','max:255'],
            'message' => ['required','string','max:5000'],
        ], [
            'first_name.required' => 'Keresztnév megadása kötelező.',
            'email.required' => 'E-mail megadása kötelező.',
            'email.email' => 'Érvényes e-mail címet adjon meg.',
            'message.required' => 'Üzenet megadása kötelező.',
        ]);

        Mail::to('eldoshato@gmail.com')->send(new ContactMessage($data));

        return back()->with('status', 'Üzenet elküldve. Hamarosan jelentkezünk!');
    }
}
