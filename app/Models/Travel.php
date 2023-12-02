<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory;

    protected $guarded = ['slug'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function books()
    {
        return $this->hasMany(UserTravel::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
