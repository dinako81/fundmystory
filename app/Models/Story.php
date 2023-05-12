<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'text', 'status', 'totalamount', 'donatedamount', 'restamount','photo'];
    public $timestamps = false;

    const STATUS = [
        1 => 'Proccesing',
        2 => 'Confirmed'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photo()
    {
        return $this->hasMany(Photo::class);
    }

    public function gallery()
    {
        return $this->hasMany(Photo::class, 'story_id', 'id');
    }
}