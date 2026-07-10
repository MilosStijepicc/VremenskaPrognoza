<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forecast extends Model
{
    protected $table = 'forecasts';

    protected $fillable = [
        'city_id',
        'temperature',
        'date',
        'weather_type',
        'probability',
    ];

    const WEATHER_TYPES = ['rainy', 'snowy', 'sunny'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
