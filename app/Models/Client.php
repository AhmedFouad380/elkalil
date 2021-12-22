<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'clients';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'user_group',
        'date',
        'branche',
        'state',
        'address',
        'ref_code',
        'is_active',
        'firebase_type',
        'token_id',
        'msg',
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state');
    }

    public function branche()
    {
        return $this->belongsTo(Branche::class, 'branche');
    }
}
