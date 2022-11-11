<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = [
        'comment',
        'article_id',
        'user_id',
    ];

    Public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    Public function article(): BelongsTo
    {
        return $this->belongsTo('App\Models\Article');
    }
}
