<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'collection_id',
        'user_id',
    ];

    public function likes(): HasMany
    {
        return $this->hasMany(User::class);
    }
}