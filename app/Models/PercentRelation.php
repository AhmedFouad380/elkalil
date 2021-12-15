<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PercentRelation extends Model
{
    use HasFactory;
    protected  $table = 'percent_relation';
    protected $fillable = [
        'comp_id',
        'client_id',
        'img',

    ];
}
