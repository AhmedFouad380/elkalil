<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    protected  $table = 'sessions';

    protected $fillable = [
        'session_id ',
        'ip_address',
        'user_agent',
        'last_activity',
        'user_data',


    ];
}
