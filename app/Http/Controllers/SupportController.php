<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SupportHasBeenContacted;

class SupportController extends Controller
{
    public function contact()
    {    
        // validate it
        request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|int',
            'message' => 'required|min:16',
        ]);    
        // send locum pap an email 
        Mail::to('info@locumpap.com')
            ->queue(new SupportHasBeenContacted(
                request('name'),
                request('email'),
                request('phone'),
                request('message')
            ));

        // todo return success page here
        return redirect('/support');

    }
}
