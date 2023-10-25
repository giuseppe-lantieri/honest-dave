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
        'imdbID',
        'collection_id',
        'user_id',
    ];

    public function likes()
    {
        return $this->belongsToMany(User::class, "likes")->withTimestamps();
    }

    public function collections(){
        return $this->belongsToMany(Collection::class)->withTimestamps();
    }
}