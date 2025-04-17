<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;

class navigator extends Authenticatable
{
    protected $table = 'navigator';
    protected $primaryKey = 'id';
    protected $timestamp = true;

    public function hospital()
    {
        return $this->belongsTo(hospitals::class, 'hospitalId', 'id');
    }


    public function broadcasts()
    {
        return $this->hasMany(Adminbroadcast::class, 'navigatorId', 'id');
    }


    // public function navigator()
    // {
    //     return $this->belongsTo(Navigator::class, 'navigatorId', 'id');
    // }

    public function requests()
    {
        return $this->hasMany(all_requests::class, 'navigator_id', 'id');
    }


    public function patients()
    {
        return $this->hasMany(patient::class, 'navigatorId', 'id');
    }

}