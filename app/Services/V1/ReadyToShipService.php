<?php

namespace App\Services\V1;

use App\Models\Order;
use App\Models\Product;

class ReadyToShipService
{
    public function updateAllReadyToShipFlags(): void
    {
        $productAvailabilityMap = $this->getProductAvailabilityMap();
        $ordersWithLineItems = Order::all();
        foreach ($ordersWithLineItems as $order) {
            $productAvailabilityMap = $this->updateProductAvailabilityMap($productAvailabilityMap, $order);
        }
    }

    public function getQuantityAvailable(Product $product)
    {
        $quantityAvailable = 0;
        foreach ($product->inventories as $inventory) {
            $quantityAvailable += $inventory->quantity_available;
        }

        return $quantityAvailable;
    }

    public function getProductAvailabilityMap(): array
    {
        $productsWithInventories = Product::all();
        $productAvailabilityMap = [];
        foreach ($productsWithInventories as $product) {
            $productAvailabilityMap[$product->product_id] = $this->getQuantityAvailable($product);
        }

        return $productAvailabilityMap;
    }

    public function updateProductAvailabilityMap(array $productAvailabilityMap, Order $order): array
    {
        $readyToShip = true;
        foreach ($order->lineItems as $lineItem) {
            if (! isset($productAvailabilityMap[$lineItem->product_id])) {
                $readyToShip = false;

                continue;
            }
            $productAvailabilityMap[$lineItem->product_id] -= $lineItem->quantity;
            if ($productAvailabilityMap[$lineItem->product_id] < 0) {
                $readyToShip = false;
            }
        }
        $order->ready_to_ship = $readyToShip;
        $order->update(['ready_to_ship' => $readyToShip]);

        return $productAvailabilityMap;
    }
}
