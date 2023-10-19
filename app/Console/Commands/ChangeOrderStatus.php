<?php

namespace App\Console\Commands;

use App\Models\Order;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use Illuminate\Console\Command;

class ChangeOrderStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:change-order-status {orderId} {status}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change status of an order.';

    /**
     * Execute the console command.
     */
    public function handle(Client $client)
    {
        try {
            $client->post(
                route('change-order-status', ['orderId' => $this->argument('orderId')]),
                [
                    RequestOptions::HEADERS => [
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ],
                    RequestOptions::BODY => json_encode(['status' => $this->argument('status')])
                ]
            );
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
            exit(-1);
        }

        $this->info('Order status changed');
    }
}
