<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Percent extends Model
{
    use HasFactory;
    protected  $table = 'percent';
    public $timestamps = false;
    protected $fillable = [
        'com_name',
        'percent',
        'cat_id',
        'project_name',
        'project_phone',
        'img',
    ];

    public function category()
    {
        return $this->belongsTo(PercentCategory::class, 'cat_id');
    }
}
