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
        Schema::create('sales_order_details', function (Blueprint $table) {
            $table->id();
            $table->string('so_number');
            $table->string('os_number');
            $table->integer('invty_id');
            $table->integer('item_id');
            $table->integer('qty');
            $table->integer('unit_id');
            $table->string('lot_no')->nullable();
            $table->date('expiration_date')->nullable();
            $table->float('unit_price');
            $table->float('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_order_details');
    }
};
