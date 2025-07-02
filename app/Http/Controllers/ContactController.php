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
        $contactData = $request->only('name', 'email', 'message');
        Contact::create($request->only('name', 'email', 'message'));
        Mail::to('psmriti6207@gmail.com')->send(new ContactFormSubmitted($contactData));
        return redirect()->back()->with('success', 'Your message has been sent!');
    }
    public function index()
{
    $contacts = Contact::latest()->get(); // Get all contact messages, newest first
    return view('admin.contacts.index', compact('contacts'));
}

}

/*Step 1: User Submits the Contact Form
File: resources/views/home/contact.blade.php

User fills in name, email, message and clicks "Submit".

Step 2: Form Sends a POST Request
Form submits to route:

Route::post('/contact', [ContactController::class, 'submitForm']);
Step 3: ContactController@submitForm() Handles the Request
File: app/Http/Controllers/ContactController.php

Tasks it performs:

Validates user input.

Saves the data into the database (Contact::create(...)).

Sends an email using Mail::to(...)->send(...).

Step 4: ContactFormSubmitted.php (Mailable Class) is Triggered
File: app/Mail/ContactFormSubmitted.php

This class:
ContactFormSubmitted.php- only for formatting ,not for displaying.
Accepts the form data.

Passes data to the email template.

Sets subject and loads email view using build().

Step 5: Email Template is Loaded
File: resources/views/emails/contact_form_submitted.blade.php

This Blade file formats the actual content of the email using the passed data like name, email, message.

Step 6: Email is Sent to the Admin (or You)
Laravel uses your email config (from .env) to send the email.

Example:
Mail::to('psmriti6207@gmail.com')->send(...)

Step 7: User is Redirected Back with Success Message
Back in submitForm():

return redirect()->back()->with('success', 'Your message has been sent!');
This shows a success message on the form page.

 */