<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsLogs extends Model
{
    use HasFactory;
    protected  $table = 'smslogs';

    protected $fillable = [
        'type',
        'user_id',
        'description',
        'sms_count',
        'created_at',
        'updated_at',

    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
