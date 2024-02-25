<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_get_customer_returns_a_successful_response(): void
    {
        $response = $this->get('/api/v1/customer');

        $response->assertStatus(200);
    }

    public function test_if_get_inventory_returns_a_successful_response(): void
    {
        $response = $this->get('/api/v1/inventory');

        $response->assertStatus(200);
    }

    public function test_if_get_line_items_returns_a_successful_response(): void
    {
        $response = $this->get('/api/v1/line-item');

        $response->assertStatus(200);
    }

    public function test_if_get_order_returns_a_successful_response(): void
    {
        $response = $this->get('/api/v1/order');

        $response->assertStatus(200);
    }

    public function test_if_get_product_returns_a_successful_response(): void
    {
        $response = $this->get('/api/v1/inventory');

        $response->assertStatus(200);
    }

    public function test_if_get_warehouse_returns_a_successful_response(): void
    {
        $response = $this->get('/api/v1/inventory');

        $response->assertStatus(200);
    }

    public function test_if_post_customer_returns_a_successful_response(): void
    {
        $response = $this->postJson(
            '/api/v1/customer',
            [
                'name' => 'Taylor Otwell',
                'type' => 'porsonal',
                'email' => 'taylor@gmail.com',
                'address' => '78 5th Ave',
                'city' => 'New York',
                'state' => 'NY',
                'postalCode' => '10011',
                'country' => 'USA',
            ]
        );

        $response->assertStatus(403);
    }

    public function test_if_post_inventory_returns_a_successful_response(): void
    {
        $product = Product::factory()->create();
        $warehouse = Warehouse::factory()->create();
        $response = $this->postJson(
            '/api/v1/inventory',
            [
                'productId' => $product->product_id,
                'warehouseId' => $warehouse->warehouse_id,
                'quantityAvailable' => 10,
                'minimumStockLevel' => 2,
                'maximumStockLevel' => 20,
            ]
        );

        $response->assertStatus(403);
    }

    public function test_if_post_line_item_returns_a_successful_response(): void
    {
        $product = Product::factory()->create();
        Customer::factory()->create();
        $order = Order::factory()->create();
        
        $response = $this->postJson(
            '/api/v1/line-item',
            [
                'productId' => $product->product_id,
                'orderId' => $order->order_id,
                'quantity' => 10,
                'price' => 1000,
            ]
        );

        $response
            ->assertStatus(201)
            ->assertJsonFragment(
                [
                    'orderId' => $order->order_id,
                    'quantity' => 10,
                    'price' => 1000,
                ]);
        $jsonProduct = $response->decodeResponseJson()['data']['product'];
        $this->assertEquals($product->product_id, $jsonProduct['productId']);
    }

    public function test_if_post_order_returns_a_successful_response(): void
    {
        $customer = Customer::factory()->create();
        $products = Product::factory()->count(2)->create();
        $response = $this->postJson(
            '/api/v1/order',
            [
                'customerId' => $customer->customer_id,
                'totalPrice' => 72000,
                'readyToShip' => false,
                'lineItems' => [
                    [
                        'productId' => $products[0]->product_id,
                        'quantity' => 8,
                        'price' => 71644,
                    ],
                    [
                        'productId' => $products[1]->product_id,
                        'quantity' => 1,
                        'price' => 899,
                    ],
                ],
            ]
        );
        $response
            ->assertStatus(201)
            ->assertJsonFragment(
                [
                    'customerId' => $customer->customer_id,
                    'totalPrice' => 72000,
                    'readyToShip' => false,
                ]);
        $lineItems = $response->decodeResponseJson()['data']['lineItems'];
        $this->assertEquals($products[0]->product_id, $lineItems[0]['product']['productId']);
        $this->assertEquals(8, $lineItems[0]['quantity']);
        $this->assertEquals(71644, $lineItems[0]['price']);
        $this->assertEquals($products[1]->product_id, $lineItems[1]['product']['productId']);
        $this->assertEquals(1, $lineItems[1]['quantity']);
        $this->assertEquals(899, $lineItems[1]['price']);
    }

    public function test_if_post_product_returns_a_successful_response(): void
    {
        $response = $this->postJson(
            '/api/v1/product',
            [
                'name' => 'Bubble Gun',
                'description' => 'The Bubble Gun is a weapon that fires a short-range spread of soap bubble projectiles.',
                'weight' => 500,
                'height' => 100,
                'width' => 50,
                'depth' => 40,
            ]
        );
        $response->assertStatus(403);
    }

    public function test_if_post_warehouse_returns_a_successful_response(): void
    {
        $response = $this->postJson(
            '/api/v1/warehouse',
            [
                'name' => 'Big Warehouse',
            ]
        );
        $response->assertStatus(403);
    }
}
