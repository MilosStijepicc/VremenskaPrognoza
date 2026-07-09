<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weather;
use App\Models\City;

class WeatherController extends Controller
{
    public function index()
    {
        $weather = Weather::with('city')->get();
        return view('dashboard', compact('weather'));
    }

    public function create()
    {
        return view('createWeather');
    }

    public function store(Request $request)
    {
        $request->validate([
            'city' => 'required|string',
            'temperature' => 'required|numeric',
        ]);

        $city = City::whereRaw('LOWER(name) = ?', [strtolower($request->city)])
            ->first();

        if (!$city) {
            return back()->withErrors([
                'city' => 'Grad ne postoji u bazi!'
            ]);
        }

        $exists = Weather::where('city_id', $city->id)->exists();

        if ($exists) {
            return back()->withErrors([
                'city' => 'Weather za ovaj grad već postoji!'
            ]);
        }

        Weather::create([
            'city_id' => $city->id,
            'temperature' => $request->temperature,
        ]);

        return redirect()->route('dashboard')->with('success', 'Weather dodan!');
    }

    public function editList()
    {
        $weather = Weather::with('city')->get();
        return view('change-weather', compact('weather'));
    }

    public function edit($id)
    {
        $weather = Weather::with('city')->findOrFail($id);
        return view('edit-weather', compact('weather'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'city' => 'required|string',
            'temperature' => 'required|numeric',
        ]);

        $weather = Weather::with('city')->findOrFail($id);

        $exists = City::whereRaw('LOWER(name) = ?', [strtolower($request->city)])
            ->where('id', '!=', $weather->city_id)
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'city' => 'Grad već postoji!'
            ]);
        }
        $weather->city->update([
            'name' => $request->city,
        ]);
        $weather->update([
            'temperature' => $request->temperature,
        ]);

        return redirect()->route('weather-change')
            ->with('success', 'Updated!');
    }

    public function destroy($id)
    {
        Weather::findOrFail($id)->delete();

        return redirect()->route('weather-change')->with('success', 'Deleted!');
    }
}
