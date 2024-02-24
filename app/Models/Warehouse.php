<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'warehouse_id';

    public function inventory()
    {
        return $this->hasMany(Inventory::class, 'warehouse_id', 'warehouse_id');
    }
}
