<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectContract extends Model
{
    use HasFactory;

    protected  $table = 'project_contract';

    protected $fillable = [
        'project_id',
        'contract_id',
        'title',
        'price',
        'template',
        'pdf',
        'color',


    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function contract()
    {
        return $this->belongsTo(Project::class, 'contract_id');
    }

}
