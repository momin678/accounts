<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Models\Contact;
class ContactController extends Controller
{
    public function contact(Request $request){
        return view('emails.contact-us');
    }
    public function contact_submit(Request $request){
         $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);
        $contact = new Contact;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->phone_number = $request->phone_number;
        $contact->message = $request->message;
        $contact->save();
        Mail::send('emails.receive_email',
         array(
             'name' => $request->get('name'),
             'email' => $request->get('email'),
             'subject' => $request->get('subject'),
             'phone_number' => $request->get('phone_number'),
             'user_message' => $request->get('message'),
         ), function($message) use ($request)
           {
              $message->from($request->email);
              $message->to('accounts@datagatebd.com');
           });
        
        return back()->with('success', 'Thank you for contact us!');
    }
}
