<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installments extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'installment_date',
        'amount',
    ];

    public function Project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
