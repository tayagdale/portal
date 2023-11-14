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
        Schema::create('inspection_details', function (Blueprint $table) {
            $table->id();
            $table->string('inspection_number');
            $table->string('po_number');
            $table->integer('item_id');
            $table->integer('qty');
            $table->timestamp('delivery_date');
            $table->string('lot_no')->nullable();
            $table->timestamp('expiration_date')->nullable();
            $table->integer('inspect_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspection_details');
    }
};
