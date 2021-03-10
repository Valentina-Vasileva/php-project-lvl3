<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function welcome() {
        $url = new Url();
        return view('welcome', compact('url'));
    }
}
