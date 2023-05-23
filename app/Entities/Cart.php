<?php

namespace App\Entities;

use App\Models\Story;

class Cart
{

    private $stories;

    public function __construct(array $cart) 
    {
        $storiesId = array_keys($cart);
        $this->stories = Story::whereIn('id', $storiesId)->get();
        $this->stories = $this->stories->map(function($p) use ($cart) {
            $p->count = $cart[$p->id];
            return $p;
        });
    }


    public function total()
    {
        return $this->stories->reduce(function ($carry, $item) {
            return $carry + $item->count * $item->price;
        }, 0);
    }

    public function stories()
    {
        return $this->stories;
    }

}