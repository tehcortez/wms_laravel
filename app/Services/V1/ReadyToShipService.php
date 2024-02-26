<?php

namespace App\Services\V1;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ReadyToShipService implements ReadyToShipServiceInterface
{
    public function updateAllReadyToShipFlags(): void
    {
        $productCollection = Product::all();
        $productAvailabilityMap = $this->getProductAvailabilityMap($productCollection);
        $orderCollection = Order::all();
        foreach ($orderCollection as $order) {
            $productAvailabilityMap = $this->updateProductAvailabilityMap($productAvailabilityMap, $order);
        }
    }

    /**
     * return a map with key as product_id and value as product availability
     * @return array<non-empty-string,integer>
     */
    private function getProductAvailabilityMap(Collection $productCollection): array
    {
        $productAvailabilityMap = [];
        foreach ($productCollection as $product) {
            $productAvailabilityMap[$product->product_id] = $this->getQuantityAvailableInStock($product);
        }

        return $productAvailabilityMap;
    }

    private function getQuantityAvailableInStock(Product $product)
    {
        $quantityAvailable = 0;
        foreach ($product->inventories as $inventory) {
            $quantityAvailable += $inventory->quantity_available;
        }

        return $quantityAvailable;
    }

    private function updateProductAvailabilityMap(array $productAvailabilityMap, Order $order): array
    {
        $readyToShip = true;
        foreach ($order->lineItems as $lineItem) {
            if (!$this->productIdExistsInAvailabilityMap($productAvailabilityMap, $lineItem->product_id)) {
                $readyToShip = false;

                continue;
            }
            $productAvailabilityMap[$lineItem->product_id] -= $lineItem->quantity;
            if ($productAvailabilityMap[$lineItem->product_id] < 0) {
                $readyToShip = false;
            }
        }
        $this->updateReadyToShipFlagInOrderModel($order, $readyToShip);

        return $productAvailabilityMap;
    }

    private function productIdExistsInAvailabilityMap(array $productAvailabilityMap, string $product_id): bool{
        if(isset($productAvailabilityMap[$product_id])){
            return true;
        }
        return false;
    }

    private function updateReadyToShipFlagInOrderModel(Order $order, bool $readyToShip): void{
        $order->ready_to_ship = $readyToShip;
        $order->update(['ready_to_ship' => $readyToShip]);
    }
}
