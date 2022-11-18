<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    public function articles()
    {
        return $this->hasMany('App\Models\article');
    }
}