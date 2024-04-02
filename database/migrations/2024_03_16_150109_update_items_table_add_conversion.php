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
        Schema::table('items', function (Blueprint $table) {
            $table->integer('uom_1')->nullable()->after('brand_name');
            $table->integer('qty_1')->nullable()->after('uom_1');
            $table->integer('uom_2')->nullable()->after('qty_1');
            $table->integer('qty_2')->nullable()->after('uom_2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            //
        });
    }
};
