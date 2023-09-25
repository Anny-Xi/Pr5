<?php

namespace App\Http\Controllers;

class WelcomeController extends Controller
{
    public function index()//$name
    {
        $todayDate = date("d.m.Y");
        return view('welcomePage', compact('todayDate'));//,'name'
        /* Here will the welcomPage.blad.php return to the view*/
    }
}
