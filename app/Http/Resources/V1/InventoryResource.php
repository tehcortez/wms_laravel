<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'inventoryId' => $this->inventory_id,
            'productId' => $this->product_id,
            // 'warehouseId' => $this->warehouse_id,
            'quantityAvailable' => $this->quantity_available,
            'minimumStockLevel' => $this->minimum_stock_level,
            'maximumStockLevel' => $this->maximum_stock_level,
            'warehouse' => new WarehouseResource($this->warehouse),
        ];
    }
}
