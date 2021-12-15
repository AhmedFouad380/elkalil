<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserChatPermission extends Model
{
    use HasFactory;

    protected  $table = 'user_chat_permissions';

    protected $fillable = [
        'reciever_id',
        'level_id',
        'project_id',
        'is_read',
        'type',
        'created_at',
        'updated_at',


    ];
}
