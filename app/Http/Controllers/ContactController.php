<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Carbon\Carbon;
use App\Models\ContactForm;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'contactForm']);
    }

    public function index()
    {
        $contact = Contact::latest()->first();
        return view('pages.contact', compact('contact'));
    }

    public function adminContact()
    {
        $contacts = Contact::latest()->paginate(5);
        return view('admin.contact.index', compact('contacts'));
    }

    public function addContact()
    {
        return view('admin.contact.create');
    }

    public function store(Request $request)
    {
        $validata_data = $request->validate([
            'address' => 'required|min:10|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric'
        ]);

        Contact::insert([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'created_at' => Carbon::now()
        ]);

        return redirect(route('admin.contact'))->with('success', 'Contact added successfully');
    }
    
    public function edit($id)
    {
        $contact = Contact::find($id);
        return view('admin.contact.edit', compact('contact'));
    }
    
    public function update(Request $request, $id)
    {
        $validata_data = $request->validate([
            'address' => 'required|min:10|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric'
        ]);

        Contact::find($id)->update([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect(route('admin.contact'))->with('success', 'Contact updated successfully');

    }

    public function destroy($id)
    {
        Contact::find($id)->delete();
        return redirect(route('admin.contact'))->with('success', 'Contact deleted successfully');
    }

    public function contactForm(Request $request)
    {
        $validata_data = $request->validate([
            'name' => 'required|min:5|max:50',
            'email' => 'required|email',
            'subject' => 'required|min:5|max:50',
            'message' => 'required|min:10|max:255'
        ]);

        ContactForm::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now()
        ]);

        return redirect()->back()->with('success', 'Your message send succefully');

    }

    public function contactMessage()
    {
        $messages = ContactForm::latest()->paginate(5); 
        return view('admin.contact.contact-message', compact('messages'));
    }

    public function messageDestroy($id)
    {
        ContactForm::find($id)->delete();
        return redirect()->back()->with('success', 'Contact message successfully deleted');
    }
}
