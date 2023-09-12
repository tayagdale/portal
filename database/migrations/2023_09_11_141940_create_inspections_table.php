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
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();
            $table->string('po_number');
            $table->string('inspection_number')->unique();
            $table->integer('supplier_id');
            $table->integer('warehouse_id');
            $table->timestamp('date')->useCurrent();
            $table->float('total_amount');
            $table->integer('encoded_by');
            $table->integer('edited_by')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspections');
    }
};
