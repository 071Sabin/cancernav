<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;

class admin extends Authenticatable
{
    protected $table = 'admin';
    protected $primaryKey = 'id';
    protected $timestamp = true;

    public function transportservices()
    {
        return $this->hasMany(transportservices::class, 'admin_id', 'id');
    }
}