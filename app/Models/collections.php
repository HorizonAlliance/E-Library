<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class collections extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id','user_id'
    ];

    function books():HasMany
    {
        return $this->hasMany(books::class);
    }

    function users():HasMany
    {
        return $this->hasMany(User::class);
    }
}
