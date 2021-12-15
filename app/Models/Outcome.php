<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    use HasFactory;

    protected  $table = 'outcomes';

    protected $fillable = [
        'project_id',
        'project_name',
        'date',
        'amount',
        'details',
        'type',

    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
