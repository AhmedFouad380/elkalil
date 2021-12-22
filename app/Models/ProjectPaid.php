<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPaid extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected  $table = 'project_paid';

    protected $fillable = [
        'project_id',
        'paid',
        'paid_down',
        'paid_term',

    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
