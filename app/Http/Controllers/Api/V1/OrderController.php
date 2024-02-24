<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreOrderRequest;
use App\Http\Requests\V1\UpdateOrderRequest;
use App\Http\Resources\V1\OrderCollection;
use App\Http\Resources\V1\OrderResource;
use App\Models\Order;
use App\Services\V1\ReadyToShipService;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $readyToShipService = new ReadyToShipService();
        $readyToShipService->updateAllReadyToShipFlags();

        return new OrderCollection(Order::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $order = Order::create($request->all());
        $readyToShipService = new ReadyToShipService();
        $readyToShipService->updateAllReadyToShipFlags();
        $order->refresh();
        if (isset($request->lineItems)) {
            foreach ($request->lineItems as $lineItem) {
                $order->lineItems()->create([
                    'product_id' => $lineItem['productId'],
                    'order_id' => $order->order_id,
                    'quantity' => $lineItem['quantity'],
                    'price' => $lineItem['price'],
                ]);
            }
        }

        return new OrderResource($order);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $readyToShipService = new ReadyToShipService();
        $readyToShipService->updateAllReadyToShipFlags();
        $order->refresh();

        return new OrderResource($order);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
