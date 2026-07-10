<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\City;

class Weather extends Model
{
    protected $fillable = [
        'city_id',
        'temperature'
    ];

    public function city()
    {
        return $this->HasOne(City::class, "id", "city_id");
    }
}
