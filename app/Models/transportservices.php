<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transportservices extends Model
{
    protected $table = 'transport_services';
    protected $primaryKey = 'id';
    protected $timestamp = true;

    public function admin()
    {
        return $this->belongsTo(admin::class);
    }
}