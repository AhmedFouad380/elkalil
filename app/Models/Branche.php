<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branche extends Model
{
    use HasFactory;

    protected $table = 'branche';
    protected $fillable = [
        'title',
        'phone',
        'state',
        'address',
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state');
    }

}
