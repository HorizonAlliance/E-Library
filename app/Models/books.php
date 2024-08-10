<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class books extends Model
{
    use HasFactory;

    protected $fillable = [
        'author',
        'title',
        'publisher',
        'category_id',
        'release_date',
        'cover',
        'file',
        'synopsis',
        'read_duration',
    ];

    function category(): BelongsTo
    {
        return $this->belongsTo(category::class);
    }

    function collections(): BelongsTo
    {
        return $this->belongsTo(collections::class);
    }

    public function permissions(): HasMany
    {
        return $this->hasMany(permissions::class);
    }



    function reviews(): HasMany
    {
        return $this->hasMany(reviews::class);
    }
}
