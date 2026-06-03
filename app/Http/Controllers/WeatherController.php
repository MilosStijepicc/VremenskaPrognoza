<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weather;

class WeatherController extends Controller
{
    public function index()
    {
        $weather = Weather::all();
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

        $exists = Weather::whereRaw('LOWER(city) = ?', [strtolower($request->city)])
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'city' => 'Grad već postoji!'
            ]);
        }

        Weather::create([
            'city' => $request->city,
            'temperature' => $request->temperature,
        ]);

        return redirect()->route('dashboard')->with('success', 'Weather dodan!');
    }

    public function editList()
    {
        $weather = Weather::all();
        return view('change-weather', compact('weather'));
    }

    public function edit($id)
    {
        $weather = Weather::findOrFail($id);
        return view('edit-weather', compact('weather'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'city' => 'required',
            'temperature' => 'required'
        ]);

        $exists = Weather::whereRaw('LOWER(city) = ?', [strtolower($request->city)])
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'city' => 'Grad već postoji!'
            ]);
        }

        $weather = Weather::findOrFail($id);

        $weather->update([
            'city' => $request->city,
            'temperature' => $request->temperature,
        ]);

        return redirect()->route('weather-change')->with('success', 'Updated!');
    }

    public function destroy($id)
    {
        Weather::findOrFail($id)->delete();

        return redirect()->route('weather-change')->with('success', 'Deleted!');
    }
}
