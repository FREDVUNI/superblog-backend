<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Category extends Model
{
    use HasFactory,HasApiTokens;
    protected $guarded = [];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
