<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Notice extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'serve_user_id',
        'post_user_id',
        'message',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
