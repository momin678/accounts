<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\EmailManager;

class NewsletterController extends Controller
{
    public function testEmail(Request $request){
        $array['view'] = 'emails.newsletter';
        dd($array);
        $array['subject'] = "SMTP Test";
        $array['from'] = env('MAIL_FROM_ADDRESS');
        $array['content'] = "This is a test email.";

        try {
            Mail::to($request->email)->queue(new EmailManager($array));
        } catch (\Exception $e) {
            dd($e);
        }

        session()->flash('success',  "Email Sent Successfull");
        return back()->with('');
    }
}
