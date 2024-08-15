<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class reviews extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','book_id','ulasan','rating'
    ];

    function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    function book():BelongsTo
    {
        return $this->belongsTo(books::class);
    }
}
