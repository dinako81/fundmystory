<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    
    public function index()
    {
        $stories = Story::all();

        return view('back.stories.index', [
            'stories' => $stories,
            'status' => Story::STATUS
        ]);
    }

    
    public function create()
    {
        //
    }

    
    public function store(StoreStoryRequest $request)
    {
        //
    }

    
    public function show(Story $story)
    {
        //
    }

    
    public function edit(Story $story)
    {
        //
    }

    
    public function update(UpdateStoryRequest $request, Story $story)
    {
        //
    }

    
    public function destroy(Story $story)
    {
        //
    }
}