<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        return $this->hasMany(permissions::class,'book_id');
    }

    public function scopeWithRecentPermissions($query){
        $oneMountAgo = Carbon::now()->subMonth();

        return $query->withCount(['permissions' => function($query) use ($oneMountAgo){
            $query->where('created_at','>=' ,$oneMountAgo );
        }])->orderBy('permissions_count','desc');
    }

    function Review(): HasMany
    {
        return $this->hasMany(reviews::class,'book_id');
    }
}
