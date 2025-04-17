<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class hospitals extends Model
{
    protected $table = 'hospital';
    protected $primaryKey = 'id';
    protected $timestamp = true;

    public function navigators()
    {
        return $this->hasMany(navigator::class, 'hospitalId', 'id');
    }

    public function diagnosis()
    {
        return $this->hasMany(diagnosis_available::class, 'hospitalid', 'id');
    }

    public function patient()
    {
        return $this->hasMany(patient::class, 'hospitalId', 'id');
    }
}