<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\Forecast;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetRealWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:get-real {city}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $city = $this->argument('city');

        $existingCity = City::where('name', $city)->first();

        if ($existingCity === null)
        {
            $existingCity = City::create([
                'name' => $city
            ]);
        }

        $response = Http::get('https://api.weatherapi.com/v1/forecast.json', [
            'key' => '937e0282b9704fbdbed91139262407',
            'q' => $city,
            'days' => 5,
        ]);

        $jsonResponse = $response->json();

        if (isset($jsonResponse['error'])) {
            dd('Nismo pronašli Vaš grad.');
        }

        //Uspio sam izvuci forecastove za narednih 5 dana, Chat mi je rekao samo da trebam koristiti dump a ne dd hahaha
        //A ja ko magarac cackam kod koristim dd xD

        //foreach ($response->json()['forecast']['forecastday'] as $day) {
        // dump(
        //  $day['date'],
        // $day['day']['avgtemp_c'],
        //  $day['day']['condition']['text']
        //  );
        // }

        foreach ($jsonResponse['forecast']['forecastday'] as $day) {

            if($existingCity->todaysForecast !== null)
            {
                $this->output->comment("Vec postoji ova prognoza");
                return;
            }

            $date = $day['date'];
            $temperature = $day['day']['avgtemp_c'];
            $weatherType = $day['day']['condition']['text'];
            $probability = $day['day']['daily_chance_of_rain'];


            $forecasts = [
                "city_id" => $existingCity->id,
                "temperature" => $temperature,
                "date" => $date,
                "weather_type" => strtolower($weatherType), //nek pise malim slovima nervira me xd
                "probability" => $probability,
            ];
            Forecast::create($forecasts);
            $this->output->comment("Dodata nova prognoza");
        }
    }
}
