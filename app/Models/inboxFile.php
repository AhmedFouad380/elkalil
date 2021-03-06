<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inboxFile extends Model
{
    use HasFactory;
    protected  $table = 'inbox_file';
    protected $fillable = [
        'mail_id',
        'file',

    ];

    public function inbox()
    {
        return $this->belongsTo(inbox::class, 'mail_id');
    }
}
