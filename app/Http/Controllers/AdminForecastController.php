<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Forecast;
use Illuminate\Http\Request;

class AdminForecastController extends Controller
{

    public function index()
    {
        $cities = City::all();

        $forecasts = Forecast::with('city')
            ->orderBy('date')
            ->get();


        return view('admin-forecasts', compact(
            'cities',
            'forecasts'
        ));
    }



    public function save(Request $request)
    {
        $request->validate([

            'city_id' => 'required|exists:cities,id',

            'temperature' => 'required|numeric',

            'weather_type' => 'required|in:rainy,sunny,snowy,cloudy',

            'date' => 'required|date',

            'probability' => [
                'nullable',
                'integer',
                'min:1',
                'max:100',
                'required_if:weather_type,rainy',
                'required_if:weather_type,snowy',
            ],

        ]);

        // Ovaj dio sam preko ChatGPT-a radio kako mi onemogućio unos prognoze rainy i snowy bez padavina
        // i da za sunny ne treba unos padavina :)
        if ($request->weather_type == 'sunny' && $request->probability != null) {

            return back()->withErrors([
                'probability' => 'Za sunčano vrijeme nije potrebna vjerovatnoća padavina.'
            ]);

        }


        if ($request->weather_type == 'sunny') {
            $probability = null;
        } else {
            $probability = $request->probability;
        }

        $exists = Forecast::where('city_id', $request->city_id)
            ->where('date', $request->date)
            ->exists();


        if ($exists) {
            return back()->withErrors([
                'date' => 'Za ovaj grad već postoji prognoza za taj datum.'
            ]);
        }

        Forecast::create([
            'city_id' => $request->city_id,
            'temperature' => $request->temperature,
            'weather_type' => $request->weather_type,
            'probability' => $probability,
            'date' => $request->date,
        ]);


        return back()->with(
            'success',
            'Prognoza uspješno dodana!'
        );
    }
}
