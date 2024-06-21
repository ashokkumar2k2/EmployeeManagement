<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class aboutus extends Controller
{
     function aboutus(){
        return view('auth.aboutus');
     }
        function contactus(){
            return view('auth.contactus');
        }
    
}
