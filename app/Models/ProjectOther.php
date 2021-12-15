<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectOther extends Model
{
    use HasFactory;

    protected  $table = 'project_other';
    protected $fillable = [
        'project_id','age','work_time','project_type2','family_num','type','living','living_features',
        'living_negatives','child_play','hobby','light_color','sleeping','future','travel','happy','party',
        'guests','coffee','details','designs','land_sell','land_area','land_size','land_trends',
        'land_location','land_nearby','home_fav','home_serv','home_floor','home_com','home_path','home_roof',
        'house','house_bedrom','house_garden','house_out','house_in','build_area','project_used','old_project',
        'rented','office'
    ];
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
