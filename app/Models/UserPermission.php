<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    use HasFactory;

    protected  $table = 'user_permission';
//    pivot table (emp - level)

    protected $fillable = [
        'level_id',
        'project_id',
        'emp_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }
    public function employee()
    {
        return $this->belongsTo(User::class, 'emp_id');
    }
}
