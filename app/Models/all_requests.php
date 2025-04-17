<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class all_requests extends Model
{
    protected $table = 'all_requests';
    protected $primaryKey = 'id';
    public $timestamps = true;


    public function navigator()
    {
        return $this->belongsTo(navigator::class, 'navigator_id', 'id');
    }


    public function patient()
    {
        return $this->belongsTo(patient::class, 'patient_id');
    }


    public function admin()
    {
        return $this->belongsTo(admin::class, 'admin_id');
    }



}