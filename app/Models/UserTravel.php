<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTravel extends Model
{
    use HasFactory;

    protected $guarded = [
        'bookedCount',
        'slug',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
