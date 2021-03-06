<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $table = 'level';
    public $timestamps = false;
    protected $fillable = [
        'title',
        'percent',
        'contract_id',
        'type',
        'sort',
        'progress_time',

    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }
}
