<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'product_id';

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'product_id', 'product_id');
    }

    public function customers(){
        return $this->belongsToMany(Customer::class, 'customer_product', 'product_id', 'customer_id');
    }
}
