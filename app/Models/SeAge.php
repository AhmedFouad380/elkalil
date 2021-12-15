<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeAge extends Model
{
    use HasFactory;

    protected  $table = 'se_age';

    protected $fillable = [
        'title',


    ];
}
