<?php

namespace App\Http\Requests\V1;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customerId' => ['required', 'uuid', 'exists:'.Customer::class.',customer_id'],
            'totalPrice' => ['required', 'integer'],
            'readyToShip' => ['boolean'],
            'lineItems' => ['array'],
            'lineItems.*.productId' => ['required', 'uuid', 'exists:'.Product::class.',product_id'],
            'lineItems.*.quantity' => ['required', 'integer'],
            'lineItems.*.price' => ['required', 'integer'],
        ];
    }

    protected function prepareForValidation()
    {
        $lineItems = $this->lineItems;
        foreach ($lineItems as &$lineItem) {
            $lineItem = array_merge($lineItem, ['product_id' => $lineItem['productId']]);
        }

        $this->merge(
            [
                'customer_id' => $this->customerId,
                'total_price' => $this->totalPrice,
                'ready_to_ship' => $this->readyToShip,
                'line_items' => $lineItems,
            ]
        );
    }
}
