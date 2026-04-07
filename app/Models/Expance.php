<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expance extends Model
{
    protected $fillable = [
        'title',
        'amount',
        'user_id',
        'category_id',
        'description',
    ];

    // public function user() {
    //     return $this->belongsTo(User::class);
    // }

    /**
     * Get the user that owns the Expance
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
