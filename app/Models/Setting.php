<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'logo',
        'phone1',
        'phone2',
        'address1',
        'address2',
        'email1',
        'email2',
        'website',
        'twitter',
        'instagram',
        'snapchat',
        'facebook',
        'priceTemplate',
        'sms_limit',
        'sms_used',
        'contractTemplate',


    ];

    public function setLogoAttribute($image)
    {
        if (is_file($image)) {
            $imageFields = upload_multiple($image,'images');
            $this->attributes['logo'] = $imageFields;
        }

    }
}
