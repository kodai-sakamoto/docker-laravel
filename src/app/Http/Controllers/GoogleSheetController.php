<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoogleSheetController extends Controller
{
    public function index()
    {
        return view('googleSheet');
    }
}
