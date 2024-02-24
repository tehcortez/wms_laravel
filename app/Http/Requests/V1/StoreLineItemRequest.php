<?php

namespace App\Http\Requests\V1;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class StoreLineItemRequest extends FormRequest
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
            'productId' => ['required', 'uuid', 'exists:'.Product::class.',product_id'],
            'orderId' => ['required', 'uuid', 'exists:'.Order::class.',order_id'],
            'quantity' => ['required', 'integer'],
            'price' => ['required', 'integer'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(
            [
                'product_id' => $this->productId,
                'order_id' => $this->orderId,
            ]
        );
    }
}
