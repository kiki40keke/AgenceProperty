<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Property;

class HomeController extends Controller
{
    public function index()
    {
        $properties =Property::with('options')->where('sold', false)->limit(4)->get();


        return view('client.index', compact('properties'));
    }
}
