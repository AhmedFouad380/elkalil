<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $table = 'contract';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'price',
        'template',
        'pdf',
        'color',
    ];
}
