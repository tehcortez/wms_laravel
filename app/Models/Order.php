<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property bool $ready_to_ship
 * @property list<LineItem> $lineItems
 * @property Customer $customer
 */
class Order extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'order_id';

    protected $fillable = [
        'customer_id',
        'total_price',
        'ready_to_ship',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function lineItems()
    {
        return $this->hasMany(LineItem::class, 'order_id', 'order_id');
    }
}
