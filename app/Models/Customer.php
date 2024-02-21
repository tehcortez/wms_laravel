<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'customer_id';

    public function orders()
    {
        return $this->hasMany(Orders::class, 'order_id', 'order_id');
    }
}
