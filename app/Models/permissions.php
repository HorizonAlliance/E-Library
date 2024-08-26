<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class permissions extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','librarian','book_id','status','note','expirated'
    ];

    function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function book(): BelongsTo
    {
        return $this->belongsTo(books::class);
    }
    public function isExpired(): bool
    {
        return $this->expirated !== null && Carbon::parse($this->expirated)->isPast();
    }
}
