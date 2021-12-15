<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $table = 'incomes';

    protected $fillable = [
        'project_id',
        'project_name',
        'date',
        'amount',
        'details',
        'type',
    ];

    public function Project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
