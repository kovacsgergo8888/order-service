<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    private const EXAMPLE_CREATE_DATA = [
        'name' => 'Johnny Silverhand',
        'email'=> 'arasaki@hater.com',
        'shipping_type' => 'COURIER_SHIPPING',
        'shipping_name' => 'Shipping John',
        'shipping_city' => 'Night City',
        'shipping_postcode' => '1234',
        'shipping_address' => 'Street 1',
        'billing_name' => 'Shipping John',
        'billing_city' => 'Night City',
        'billing_postcode' => '1234',
        'billing_address' => 'Street 1',
        'order_products' => [
            [
                'name' => 'gun',
                'price' => 12,
                'quantity' => 10
            ]
        ]
    ];

    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_order_list(): void
    {
        $this->seed();
        $response = $this->post('/api/orders/list');

        $response->assertStatus(200);
        $this->assertEquals(100, substr_count($response->getContent(), 'order_id'));
    }

    public function test_order_create(): void
    {
        $response = $this->post('/api/orders', self::EXAMPLE_CREATE_DATA);
        $response->assertStatus(200);
        $this->assertStringContainsString('order_id', $response->getContent());
    }

    public function test_order_total(): void
    {
        $this->post('/api/orders', self::EXAMPLE_CREATE_DATA);
        $response = $this->post('/api/orders/list');
        $this->assertStringContainsString('order_total":120', $response->getContent());
    }

    public function test_change_order_status(): void
    {
        $response = $this->post('/api/orders', self::EXAMPLE_CREATE_DATA);
        $data = json_decode($response->getContent(), true);
        $response = $this->post("/api/order/{$data['order_id']}/status", [
            'status' => "FULLFILLED"
        ]);

        $response->assertStatus(200);
        $this->assertStringContainsString('FULLFILLED', $response->getContent());
    }
}
