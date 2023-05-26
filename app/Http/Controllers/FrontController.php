<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\Order;
use App\Models\Photo;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $stories = Story::all();
        $id = $request->id ?? 0;

        $sort = $request->sort ?? '';
        
        // $filter = $request->filter ?? '';

        // $stories = match($filter) {
        //     'stories' => $stories,
        //     'acc_balance_pos' => $stories->where('acc_balance', '>', 0),
        //     default => $stories
        // };
        
        $stories = match($sort) {
            'stories' => $stories,
            'rates 0' => $stories->where('rates', '=', 0 ),
            'rates 1-3' => $stories->where('rates', '>', 0 && 'rates', '<', 4),
            'rates 4-150' => $stories->where('rates', '>', 3 && 'rates', '<', 151),
            default => $stories
        };



        $request->session()->put('last-client-view', [
            'sort' => $sort,
            // 'filter' => $filter,
        ]);

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
            'stories' => $stories,
            'sortSelect' => Story::SORT,
            'sort' => $sort,
            // 'filterSelect' => Client::FILTER,
            // 'filter' => $filter
        ]);
    }

    


    public function stories(Request $request)
    {
             
        $stories = $request->user();

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

    
    public function orders(Request $request)
    {
        $orders = $request->user()->order;

        return view('front.orders', [
            'orders' => $orders,
            'status' => Order::STATUS
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

    public function gallery(Photo $photo, Story $story)
    {
        $photos = Photo::all();
        $stories = Story::all();
        return view('front.gallery', [
            'story' => $story,
            'stories' => $stories,
            'photos' => $photos,
            'photo' => $photo,
        ]);
    }


}