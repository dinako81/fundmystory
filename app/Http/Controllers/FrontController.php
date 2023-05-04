<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $stories = Story::all();

        return view('front.index', [
            'stories' => $stories
        ]);
    }
}