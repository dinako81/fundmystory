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

    
   
    public function store(Request $request, Story $story)
    {
    
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:100',
            'text' => 'required|min:3|max:1000',
            'totalamount' => 'required|numeric',
            // 'donatedamount' => 'required|numeric',
            // 'restamount' => 'required|numeric',
            'photo' => 'sometimes|required|image|max:512',
            'gallery.*' => 'sometimes|required|image|max:512'
        ]);

        if ($validator->fails()) {
            $request->flash();
            return redirect()
                ->back()
                ->withErrors($validator);
        }
        
        $photo = $request->photo;
        if ($photo) {
            $name = $story->savePhoto($photo);
        }
        $id = Story::create([
            'title' => $request->title,
            'text' => $request->text,
            'totalamount' => $request->totalamount,
            'donatedamount' => $request->donatedamount,
            'restamount' => $request->restamount,
            'photo' => $name ?? null
        ])->id;

        foreach ($request->gallery ?? [] as $gallery) {
            Photo::add($gallery, $id);
        }

        return redirect()->route('stories-index');
    }

    
    public function show(Story $story)

    {
        $stories = Story::all();
        
        return view('back.stories.show', [
            'story' => $story,
            'stories' => $stories,

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
        if ($request->delete == 1) {
            $story->deletePhoto();
            return redirect()->back();
        }

        $photo = $request->photo;

        if ($photo) {
            $name = $story->savePhoto($photo);
            $story->deletePhoto();
            $story->update([
                'title' => $request->title,
                'photo' => $name
            ]);
        } else {

        $story->update([
            'title' => $request->title,
            'text' => $request->text,
            
        ]);
    }

        foreach ($request->gallery ?? [] as $gallery) {
            Photo::add($gallery, $story->id);
        }

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
        
        if ($story->gallery->count()) {
            foreach ($story->gallery as $gal) {
                $gal->deletePhoto();
            }
        }
        
        if ($story->photo) {
            $story->deletePhoto();
        }
        
        $story->delete();
        return redirect()->route('stories-index');
    }


    public function destroyPhoto(Photo $photo)
    {
        $photo->deletePhoto();
        return redirect()->back();
    }
}