<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customer_product', function (Blueprint $table) {
            $table->uuid('customer_product_id')->primary();
            $table->uuid('customer_id');
            $table->foreign('customer_id')->references('customer_id')->on('customers');
            $table->uuid('product_id');
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_product');
    }
};
