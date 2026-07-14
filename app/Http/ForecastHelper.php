<?php

namespace App\Http;

class ForecastHelper
{

    public static function temperatureColor($temperature)
    {
        if ($temperature <= 0) {
            return 'lightblue';
        }

        if ($temperature <= 15) {
            return 'blue';
        }

        if ($temperature <= 25) {
            return 'green';
        }

        if ($temperature > 25) {
            return 'red';
        }
    }


    public static function weatherIcon($weatherType)
    {
        if ($weatherType == 'sunny') {
            return 'fa-solid fa-sun text-warning';
        }

        if ($weatherType == 'rainy') {
            return 'fa-solid fa-cloud-rain text-primary';
        }

        if ($weatherType == 'snowy') {
            return 'fa-solid fa-snowflake text-info';
        }

        if ($weatherType == 'cloudy') {
            return 'fa-solid fa-cloud text-secondary';
        }

        return '';
    }

}
