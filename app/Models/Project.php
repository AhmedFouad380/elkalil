<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';
    protected $appends = ['deliveryDate'];


    public function getDeliveryDateAttribute()
    {
        $sum =  ProjectLevels::where('project_id',$this->attributes['id'])->sum('progress_time');
        $data = \Carbon\Carbon::parse($this->attributes['confirm_date'])->addDays($sum)->format('Y-m-d');
        return $data;
    }

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

    public function State()
    {
        return $this->belongsTo(State::class, 'state', 'id');
    }


    public function contract()
    {
        return $this->hasOne(ProjectContract::class, "contract_id");

    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id')->withDefault([
            'name'=>"",
            'email'=>"",
            'phone'=>""
        ]);
    }

    public function projectContract()
    {
        return $this->hasOne(ProjectContract::class, 'project_id');
    }


    public function assginUsers()
    {
        return $this->belongsToMany(User::class, 'user_permission', 'project_id', 'emp_id')->distinct();
    }

    public function income()
    {
        return $this->hasMany(Income::class, 'project_id');
    }

    public function installments()
    {
        return $this->hasMany(Installments::class, 'project_id');
    }

    public function projectPaid()
    {
        return $this->hasOne(ProjectPaid::class, 'project_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
