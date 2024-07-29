<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTelegram extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'secret',
        'chat_id',
        'status',
        'created_at'
    ];

    protected $table = 'user_telegram';

    public function users()
    {
        return $this->HasOne(User::class, 'user_id');
    }
}
