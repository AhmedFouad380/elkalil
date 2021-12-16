<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    use HasFactory;

    protected  $table = 'user_group';

    protected $fillable = [
        'title',
        'type',
        'is_client_order',
        'is_contracting',
        'is_projects',
        'is_report',
        'is_financial',
        'is_settings',
        'is_progressTime',

    ];
}
