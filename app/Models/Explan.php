<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Explan extends Model
{
    use HasFactory;

    protected  $table = 'explan';
    protected $fillable = [
        'title',
        'comments',
        'date',
        'time',
        'emp_id',
        'emp_name',
        'project_id',

    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'emp_id');
    }
}
