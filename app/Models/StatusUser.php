<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusUser extends Model
{
    protected $fillable = [
        'user_id',
        'status_id',
    ];
}