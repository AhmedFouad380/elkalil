<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    protected  $table = 'level';

    protected $fillable = [
        'title',
        'percent',
        'contract_id',
        'type',
        'sort',

    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }
}
