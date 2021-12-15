<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectLevels extends Model
{
    use HasFactory;
    protected  $table = 'project_levels';

    protected $fillable = [
        'title',
        'percent',
        'contract_id',
        'type',
        'project_id',
        'project_contract_id',
        'percent',
        'progress',
        'level_id',
        'notification',
        'client_view',
        'progress_time',
        'emp_id',
        'auto_complete',
        'created_by', 
        'sort',

    ];
}
