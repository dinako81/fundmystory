<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Story;


class StoryService
{
    public function get()
    {
        return Story::all();
    }
}