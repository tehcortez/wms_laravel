<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LineItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'line_item_id' => $this->line_item_id,
            'productId' => $this->product_id,
            'orderId' => $this->order_id,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ];
    }
}
