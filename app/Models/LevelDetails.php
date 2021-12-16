<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelDetails extends Model
{
    use HasFactory;
    protected  $table = 'level_details';

    protected $fillable = [
        'title',
        'level_id',
        'percent',
        'type',
        'pdf',
        'comment',
        'is_pdf',
        'state',
        'values',
        'question_type',
        'client_view',
        'sort',

    ];

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state');
    }
}
