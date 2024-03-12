<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'product_id';

    public function inventories(): HasMany
    {
        return $this->hasMany(Inventory::class, 'product_id', 'product_id');
    }

    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(Customer::class, 'customer_product', 'product_id', 'customer_id');
    }

    public function getQuantityAvailableInStock(): int
    {
        $quantityAvailable = 0;
        foreach ($this->inventories as $inventory) {
            $quantityAvailable += $inventory->quantity_available;
        }
        return $quantityAvailable;
    }
}
