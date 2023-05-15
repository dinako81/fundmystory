<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $stories = Story::all();

        $stories->map(function($p) use ($request) {

            //VOTES
            if (!$request->user()) {
                $showVoteButton = false;
                // jeigu neprisilogines-nerodom
            } else {
                $rates = collect($p->rates);
                $showVoteButton = $rates->first(fn($r) => $r['userId'] == $request->user()->id) ? false : true;
            }
            $p->votes = count($p->rates);
            $p->showVoteButton = $showVoteButton;

            // TAGS
            // $tagsId = $p->storyTag->pluck('tag_id')->all();
            // $tags = Tag::whereIn('id', $tagsId)->get();
            // $p->tags = $tags;

        });
        return view('front.index', [
            'stories' => $stories
        ]);
    }

    public function showStory(Story $story)
    {
        $stories = Story::all();
        
        return view('front.stories', [
            'story' => $story,
            'stories' => $stories,
        ]);
    }


    public function stories(Request $request)
    {
        $stories = $request->user()->story;

        return view('front.stories', [
            'stories' => $stories,
            'status' => Story::STATUS
        ]);
    }

    public function storyTitle(Story $story)
    {
        $titles = $story->title;

        return view('front.index', [
            'titles' => $titles,
            'story' => $story
        ]);
    }


    public function vote(Request $request, Story $story)
    {
        // ar yra useris
        if ($request->user()) {
            $userId = $request->user()->id;
            $rates = collect($story->rates);
// jeigu dar neprabalsaves/ar siuncia starsus
            if (!$rates->first(fn($r) => $r['userId'] == $userId) && $request->star) {
                $stars = count($request->star);
                
                $userRate = [
                    'userId' => $userId,
                    'rate' => $stars
                ];
                $rates->add($userRate);
                // pridedam i kolekciaj nauja nari
                $rate = round($rates->sum('rate') / $rates->count(), 2);
                // reitingo vidurkio skaiciavimas

                $story->update([
                    'rate' => $rate,
                    'rates' => $rates,
                ]);
            }

            return redirect()->back();
        }
        
    }
}