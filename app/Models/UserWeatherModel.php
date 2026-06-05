<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWeatherModel extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];
}
