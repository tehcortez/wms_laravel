<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'productId' => $this->product_id,
            'name' => $this->name,
            'description' => $this->description,
            'weight' => $this->weight,
            'height' => $this->height,
            'width' => $this->width,
            'depth' => $this->depth,
            'inventories' => new InventoryCollection($this->inventories),
        ];
    }
}
