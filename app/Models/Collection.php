<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        "user_id"
    ];

    public function items(): HasMany
    {
        return $this->HasMany(Item::class);
    }
}