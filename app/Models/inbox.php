<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inbox extends Model
{
    use HasFactory;
    protected  $table = 'inbox';
    protected $fillable = [
        'title',
        'comments',
        'date',
        'time',
        'sender_id',
        'sender_name',
        'recipient_id',
        'recipient_name',
        'project_id',
        'project_name',
        'level_id',
        'level_type',
        'level_name',
        'empl',
        'sub',
        'view',
        'client_view',
        'is_Replay',
        'updated_at',
        'mail_type',
    ];


    public function Project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function Level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function files()
    {
        return $this->hasMany(inboxFile::class, 'mail_id');
    }

    public function replies()
    {

        return $this->hasMany(inbox::class, 'sub');
    }




}
