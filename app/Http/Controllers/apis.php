<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class apis extends Controller
{
    //
    function try_apis(){

        $user_id = user::where('id',1)->get();

        return view('layouts/try_apis');
    }
}
