<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookSuggestionsLike extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'suggestions_id',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bookSuggestions() : BelongsTo
    {
        return $this->belongsTo(BookSuggestions::class,'suggestions_id');
    }
}
