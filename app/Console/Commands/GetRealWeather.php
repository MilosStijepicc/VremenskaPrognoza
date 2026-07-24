<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetRealWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:get-real';

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
        //Koristio sam ovaj API key jer ReqRes-ov API key vise ne radi
        //$url = "https://jsonplaceholder.typicode.com/users";
        //$response = Http::get($url);

        //$jsonResponse = $response->body();
        //$jsonResponse = (json_decode($jsonResponse, true));
        //dd($jsonResponse[0]['name']);

        //Ispod je domaci :)

        $response = Http::get('https://api.weatherapi.com/v1/current.json', [
            'key' => '937e0282b9704fbdbed91139262407',
            'q' => 'Modrica'
        ]);

        dd($response->status(), $response->json()['location']['name'], $response->json()['current']['temp_c']);}
}
