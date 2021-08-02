<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class);
    }
}
