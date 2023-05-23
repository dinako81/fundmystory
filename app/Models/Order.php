<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['stories', 'user_id', 'status'];
    public $timestamps = false;
    protected $casts = [
        'orders' => 'array',
    ];
    const STATUS = [
        1 => 'Proccesing',
        2 => 'Confirmed'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}