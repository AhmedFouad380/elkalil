<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeArea extends Model
{
    use HasFactory;

    protected  $table = 'se_area';

    protected $fillable = [
        'title',


    ];
}
