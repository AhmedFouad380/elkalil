<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected  $table = 'messages';
    public $timestamps = false;

    protected $fillable = [
        'sender_id',
        'sender_name',
        'type',
        'message',
        'project_id',
        'level_id',
        'file',
        'is_delete',
        'created_at',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function setFileAttribute($image)
    {
        if (is_file($image)) {
            $imageFields = upload_multiple3($image,'images');
            $this->attributes['file'] = $imageFields;
        }
    }

}
