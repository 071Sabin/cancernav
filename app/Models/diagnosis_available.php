<?php

namespace App\Models;

use App\Models\hospitals;
use Illuminate\Database\Eloquent\Model;

class diagnosis_available extends Model
{
    protected $table = 'diagnosis';
    protected $primaryKey = 'id';
    protected $timestamp = true;

    public function hospital()
    {
        return $this->belongsTo(hospitals::class, 'hospitalid', 'id');
    }
}