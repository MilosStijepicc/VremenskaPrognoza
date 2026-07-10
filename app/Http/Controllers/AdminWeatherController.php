<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Weather;
use Illuminate\Http\Request;

class AdminWeatherController extends Controller
{
    public function index()
    {
        $cities = City::all();

        $weather = Weather::with('city')->get();

        return view('weather-index', compact('cities', 'weather'));
    }


    public function update(Request $request)
    {
        $request->validate([
            "temperature" => "required",
            "city_id" => "required|exists:cities,id",
        ]);

        $weather = Weather::where("city_id", $request->city_id)->first();

        if (!$weather) {
            return redirect()->back()
                ->withErrors([
                    'city_id' => 'Za ovaj grad ne postoji weather zapis.'
                ]);
        }

        $weather->temperature = $request->temperature;
        $weather->save();

        return redirect()->back()
            ->with('success', 'Temperatura uspješno izmijenjena!');
    }
}
