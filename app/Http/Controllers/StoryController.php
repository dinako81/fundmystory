<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class storyController extends Controller
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
            'totalamount' => $request->totalamount,
            'donatedamount' => $request->donatedamount,
            'restamount' => $request->restamount
        ])->id;

        return redirect()->route('stories-index');
    }

    
    public function show(Story $story)
    {
        return view('back.stories.show', [
            'story' => $story
        ]);
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

    public function editamount(Story $story)
    {
        return view('stories.edit', [
            'totalamount' => $totalamount
        ]);
    }

    
    public function donateamount(Request $request, Story $story)
    {

        // validacija donated <= rest

        if(!$request->type) {
            $story->totalamount = $story->totalamount;
            $story->donatedamount = $story->donatedamount + $request->donatedamount;
            $story->restamount = $story->totalamount - $story->donatedamount;
            $story->save();
        
            return redirect()
            ->route('stories-index')
            ->with('info', 'Funds was added');  
     
        }
    }
    
    public function destroy(Story $story)
    {
        $story->delete();
        return redirect()->route('stories-index');
    }

    public function destroyPhoto(Photo $photo)
    {
        $photo->deletePhoto();
        return redirect()->back();
    }
}