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

       const STATUS = [
        1 => 'Proccesing',
        2 => 'Confirmed'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
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