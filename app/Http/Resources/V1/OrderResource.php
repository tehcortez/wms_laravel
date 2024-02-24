<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'orderId' => $this->order_id,
            'customerId' => $this->customer_id,
            'totalPrice' => $this->total_price,
            'readyToShip' => $this->ready_to_ship,
            'lineItems' => new LineItemCollection($this->lineItems),
        ];
    }
}
