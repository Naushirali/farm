<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemperatureData extends Model
{
    protected $table = 'temperature_data';

    protected $fillable = ['device_id', 'temperature'];
    public $timestamps = false;
}

