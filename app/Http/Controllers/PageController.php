<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function welcome(): object
    {
        return view('welcome');
    }
}
