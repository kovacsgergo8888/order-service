<?php

namespace App\Console\Commands;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Console\Command;

class ListOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:list-orders {--orderId=} {--status=} {--createdAfter=} {--createdBefore=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function handle(Client $client)
    {
        try {
            $response = $client->post(
                route('list-orders'),
                [
                    RequestOptions::HEADERS => [
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ],
                    RequestOptions::BODY => $this->options() ? json_encode($this->options()) : null
                ]
            );
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
            exit(-1);
        }

        $this->line($response->getBody());
    }
}
