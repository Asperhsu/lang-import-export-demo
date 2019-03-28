<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('index');
    }

    public function files()
    {
        return collect(Storage::disk('lang')->allFiles())->filter(function ($filename) {
            return strrpos($filename, '.php');
        })->values();
    }
}
