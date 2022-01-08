<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectLevelDetails extends Model
{
    use HasFactory;

    protected $table = 'project_level_details';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'percent',
        'level_id',
        'state',
        'project_id',
        'emp_id',
        'type',
        'pdf',
        'id_pdf',
        'comment',
        'values',
        'question_type',
        'answer',
        'otherAnswer',
        'date',
        'client_view',
        'sort',
        'img',
        'UserAdded',


    ];

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'emp_id');
    }
}
