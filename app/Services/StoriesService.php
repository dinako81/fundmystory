<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Story;


class StoriesService
{
    public function get()
    {
        return Story::all();
    }
}