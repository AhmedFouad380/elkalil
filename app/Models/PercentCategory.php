<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PercentCategory extends Model
{
    use HasFactory;

    protected  $table = 'percent_category';

    protected $fillable = [
        'name',
    ];

    public function percent()
    {
        return $this->hasMany(Percent::class, 'cat_id');
    }
}
