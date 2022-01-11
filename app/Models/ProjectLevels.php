<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectLevels extends Model
{
    use HasFactory;
    protected  $table = 'project_levels';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'percent',
        'contract_id',
        'project_contract_id',
        'project_id',
        'level_id',
        'created_by',
        'emp_id',
        'type',
        'percent',
        'progress',
        'notification',
        'client_view',
        'progress_time',
        'auto_complete',
        'sort',

    ];



    public function assginUsers(){
        return $this->belongsToMany(User::class,'user_permission','level_id','emp_id')->distinct();
    }
    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }

    public function project_contract()
    {
        return $this->belongsTo(ProjectContract::class, 'project_contract_id');
    }

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
