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
        Schema::create('incoming_payment_details', function (Blueprint $table) {
            $table->id();
            $table->string('or_number');
            $table->string('si_number');
            $table->string('dr_number');
            $table->string('so_number');
            $table->string('os_number');
            $table->integer('invty_id');
            $table->integer('item_id');
            $table->integer('qty');
            $table->integer('unit_id');
            $table->string('lot_no')->nullable();
            $table->timestamp('expiration_date');
            $table->float('unit_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incoming_payment_details');
    }
};
