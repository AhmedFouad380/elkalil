<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inbox extends Model
{
    use HasFactory;
    protected  $table = 'inbox';
    protected $fillable = [
        'title',
        'comments',
        'date',
        'time',
        'sender_id',
        'sender_name',
        'recipient_id',
        'recipient_name',
        'project_id',
        'project_name',
        'level_id',
        'level_type',
        'level_name',
        'empl',
        'sub',
        'view',
        'client_view',
        'is_Replay',
        'updated_at',
        'mail_type',
    ];


}
