<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'chat_room_id',
        'user_id',
        'message'
    ];

    // protected static function boot()
    // {
    //     parent::boot();
    //     static::creating(function ($model) {
    //         $model->{$model->getKeyName()} = (string) \Str::uuid();
    //     });
    // }

    public function chatRoom()
    {
        return $this->belongsTo('App\Models\ChatRoom');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
