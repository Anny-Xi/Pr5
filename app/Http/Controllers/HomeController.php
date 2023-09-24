<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()//$name
    {
        $todayDate = date("d.m.Y");
        return view('home', compact('todayDate'));//,'name'
    }
}
