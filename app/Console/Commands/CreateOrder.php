<?php

namespace App\Console\Commands;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Console\Command;

class CreateOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-order {createOrderRequestBody}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(Client $client)
    {
        try {
            $response = $client->post(
                route('create-order'),
                [
                    RequestOptions::HEADERS => [
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ],
                    RequestOptions::BODY => $this->argument('createOrderRequestBody')
                ]
            );
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
            exit(-1);
        }

        $this->info('Order created');
        $this->line($response->getBody());
    }
}
