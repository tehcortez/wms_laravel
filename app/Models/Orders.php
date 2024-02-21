<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'order_id';

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function lineItem()
    {
        return $this->hasMany(LineItem::class, 'line_item_id', 'line_item_id');
    }
}
