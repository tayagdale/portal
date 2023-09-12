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
        Schema::create('incoming_payment', function (Blueprint $table) {
            $table->id();
            $table->string('or_number')->unique();
            $table->string('si_number');
            $table->string('dr_number');
            $table->string('so_number');
            $table->string('os_number');
            $table->integer('customer_id');
            $table->timestamp('date')->useCurrent();
            $table->integer('terms');
            $table->integer('payment_mode');
            $table->integer('payment_type');
            $table->string('check_number')->nullable();
            $table->float('payment_amount');
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
        Schema::dropIfExists('incoming_payment');
    }
};
