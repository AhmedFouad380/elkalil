<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectLevelDetails extends Model
{
    use HasFactory;

    protected  $table = 'project_level_details';

    protected $fillable = [
        'title',
        'percent',
        'level_id',
        'type',
        'project_id',
        'pdf',
        'id_pdf',
        'comment',
        'state',
        'values',
        'question_type',
        'answer',
        'otherAnswer',
        'emp_id',
        'date',
        'client_view',
        'sort',
        'img',
        'UserAdded',


    ];
}
