<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BookSuggestions extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'author',
        'publisher',
        'description',
        'likes',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function suggestionsLike() : HasMany
    {
        return $this->hasMany(BookSuggestionsLike::class,'suggestions_id');
    }
}
