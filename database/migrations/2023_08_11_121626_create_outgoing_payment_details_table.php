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
        Schema::create('outgoing_payment_details', function (Blueprint $table) {
            $table->id();
            $table->string('por_number')->unique();
            $table->string('inspection_number');
            $table->string('po_number');
            $table->integer('item_id');
            $table->integer('unit_id');
            $table->integer('unit_price');
            $table->integer('qty');
            $table->string('lot_no')->unique()->nullable();
            $table->timestamp('expiration_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outgoing_payment_details');
    }
};
