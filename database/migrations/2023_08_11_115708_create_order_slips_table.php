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
        Schema::create('order_slips', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->string('os_number')->unique();
            $table->integer('terms')->nullable();
            $table->timestamp('date')->useCurrent();
            $table->integer('encoded_by');
            $table->integer('edited_by')->nullable();
            $table->timestamps();
            $table->integer('status')->default('4');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_slips');
    }
};
