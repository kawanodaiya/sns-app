<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = [
        'follower_id',
        'followee_id',
    ];

    public function articles(): HasMany
    {
        return $this->hasMany('App\Models\Article');
    }
}