<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\UploadedFile;

class Story extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'text', 'status', 'totalamount', 'donatedamount', 'restamount','photo', 'rate', 'rates', 'donations', 'donors'];
    public $timestamps = false;
    
    protected $casts = [
        'donations', 'rates' => 'array'
        
    ];

    const SORT = [
        'default' => 'Be rūšiavimo',
        'rates0-50' => 'Hearts 1-50',
        'rates51-100' => 'Hearts 50-100',
        'rates101-150' => 'Hearts 100-150',
    ];

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

    public function deletePhoto()
    {
        if ($this->photo) {
            $photo = public_path() . '/stories-photo/' . $this->photo;
            unlink($photo);
            $photo = public_path() . '/stories-photo/t_' . $this->photo;
            unlink($photo);
        }
        $this->update([
            'photo' => null,
        ]);
    }

    public function savePhoto(UploadedFile $photo) : string
    // uploaded file butinai, kitaip nezinos koks metodas
    {
        $name = $photo->getClientOriginalName();
        $name = rand(1000000, 9999999) . '-' . $name;
        $path = public_path() . '/stories-photo/';
        $photo->move($path, $name);
        $img = Image::make($path . $name);
        $img->resize(200, 200);
        $img->save($path . 't_' . $name, 90);
        return $name;
    }
}