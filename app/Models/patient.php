<?php

namespace App\Models;

use App\Models\navigator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class patient extends Authenticatable
{
    protected $table = 'patient';
    protected $primaryKey = 'id';
    protected $timestamp = true;


    public function navigator()
    {
        return $this->belongsTo(navigator::class, 'navigatorId', 'id');
    }

    public function requests()
    {
        return $this->hasMany(all_requests::class, 'patient_id', 'id');
    }

    public function hospital()
    {
        return $this->belongsTo(hospitals::class, 'hospitalId', 'id');
    }
}