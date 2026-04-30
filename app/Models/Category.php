<?php

namespace App\Models;

use App\Models\Scopes\UserCategoryScope;
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


    protected static function booted()
    {
        static::addGlobalScope(new UserCategoryScope);
    }

    public function Expenses(): HasMany
    {
        return $this->hasMany(Expance::class, 'category_id', 'id');
    }
}
