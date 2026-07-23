<?php

namespace App\Http\Controllers;

use App\Models\UserCity;
use App\Models\City;
use Illuminate\Http\Request;

class UserCitiesController extends Controller
{
    public function favourite(Request $request, $city)
    {
        $user = auth()->user();

        if ($user === null) {
            return redirect()->back()->with('error', 'Morate biti ulogovani da biste dodali grad u favorite.');
        }

        $cityModel = City::where('name', $city)->first();

        if (!$cityModel) {
            return redirect()->back()->with('error', 'Grad nije pronađen.');
        }

        UserCity::create([
            'user_id' => $user->id,
            'city_id' => $cityModel->id
        ]);

        return redirect()->back();
    }

    public function remove($city)
    {
        $user = auth()->user();

        if ($user === null) {
            return redirect()->back()->with('error', 'Morate biti ulogovani.');
        }

        $cityModel = City::where('name', $city)->first();

        if (!$cityModel) {
            return redirect()->back()->with('error', 'Grad nije pronađen.');
        }

        UserCity::where('user_id', $user->id)
            ->where('city_id', $cityModel->id)
            ->delete();

        return redirect()->back();
    }

}
