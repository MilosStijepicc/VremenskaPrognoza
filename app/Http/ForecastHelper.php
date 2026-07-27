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

        return 'red';
    }


    public static function weatherIcon($weatherType)
    {
        $icons = [
            'sunny' => 'fa-solid fa-sun text-warning',
            'rainy' => 'fa-solid fa-cloud-rain text-primary',
            'snowy' => 'fa-solid fa-snowflake text-info',
            'cloudy' => 'fa-solid fa-cloud text-secondary',
        ];


        if (in_array($weatherType, array_keys($icons))) {
            return $icons[$weatherType];
        }else{
            return "fa-solid fa-sun";
        }


        return '';
    }

}
