<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected  $table = 'projects';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'phone',
        'email',
        'services',
        'country',
        'state',//
        'know_us',
        'project_type',
        'area',
        'duration',
        'plan',
        'client_id',//
        'date',
        'lat',
        'lng',
        'address_type',
        'address_link',
        'is_customer',
        'is_contract',
        'is_accepted',
        'accept_date',
        'confirm',
        'confirm_date',
        'progress',
        'percent',
        'notification',
        'is_archive',
        'archive_date',
        'view',
        'estbian_type',
        'financial_type',
        'template_type',
        'price_type',
        'created_by',
        'is_created',

    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function projectContract(){
        return $this->hasOne(ProjectContract::class , 'project_id');
    }
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
