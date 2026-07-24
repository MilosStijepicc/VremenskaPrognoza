<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-command';

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
        //I ovdje sam koristio isti API jer se nisam nesto snasao na ReqResu...
        //$url = "https://jsonplaceholder.typicode.com/users";
        //$response = Http::get($url);
        //dd($response->json()[0]['name']); Probao sam sa ovim i ispisao ime prvog usera :)
        //Ovo radi

        $response = Http::post('https://dummyjson.com/products/add',[
            'title' => 'Novi proizvod',
            'price' => 500
        ]);
        dd($response->json());
    }
}
