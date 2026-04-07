<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'icon',
        'user_id',
    ];

    protected $table = 'categories';

    
    public function Expenses(): HasMany
    {
        return $this->hasMany(Expance::class, 'category_id', 'id');
    }
}
