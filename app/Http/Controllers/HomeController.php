<?php

namespace App\Http\Controllers;

use Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($request)
    {
        return view('home');
    }
}
