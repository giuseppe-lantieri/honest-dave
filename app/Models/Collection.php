<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        "user_id"
    ];

    public function items()
    {
        return $this->hasMany(Item::class)->orderBy("id", "desc");
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, "favorites")->withTimestamps();
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}