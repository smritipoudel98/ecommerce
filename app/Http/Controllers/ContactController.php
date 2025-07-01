<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmitted;
use Illuminate\Http\Request;
use App\Models\Contact;
class ContactController extends Controller
{
    public function showForm()
    {
        return view('home.contact');
    }
   // ContactController.php

    

    public function submitForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        Contact::create($request->only('name', 'email', 'message'));

        return redirect()->back()->with('success', 'Your message has been sent!');
    }
    public function index()
{
    $contacts = Contact::latest()->get(); // Get all contact messages, newest first
    return view('admin.contacts.index', compact('contacts'));
}

}