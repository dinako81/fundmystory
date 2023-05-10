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
        $stories = Story::all();
        
        return view('back.stories.create', [
            'stories' => $stories
        ]);
    }

    
    public function store(Request $request)
    {
        $id = Story::create([
        
            'title' => $request->title,
            'text' => $request->text,
            'totalfund' => $request->totalfund
        ])->id;

        return redirect()->route('stories-index');
    }

    
    public function show(Story $story)
    {
        //
    }

    
    public function edit(Story $story)
    {
        return view('back.stories.edit', [
            'story' => $story
        ]);
    }

    
    public function update(Request $request, Story $story)
    {
        $story->update([
            'title' => $request->title,
            'text' => $request->text,
        ]);

        return redirect()->route('stories-index');
    }

    
    public function destroy(Story $story)
    {
        $story->delete();
        return redirect()->route('stories-index');
    }
}