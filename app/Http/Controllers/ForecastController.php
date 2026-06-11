<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForecastController extends Controller
{
    public function index($city)
    {
        $forecasts = [
            'beograd' => [12, 14, 16, 15, 13],
            'sarajevo' => [8, 9, 11, 10, 7],
        ];

        $cityKey = strtolower($city);

        if (!isset($forecasts[$cityKey])) {
            return view('forecast', [
                'city' => $city,
                'temps' => null
            ]);
        }

        return view('forecast', [
            'city' => $city,
            'temps' => $forecasts[$cityKey]
        ]);
    }
}
