<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function daftar()
    {
        return view('daftar');
    }
    public function submit(Request $request)
    {
        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');

        return view('home', ["firstName" => $firstName, "lastName" => $lastName]);
    }
}
