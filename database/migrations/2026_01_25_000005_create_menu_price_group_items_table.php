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
        Schema::create('menu_price_group_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('menu_price_group_id');
            $table->string('item_name');
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->foreign('menu_price_group_id')->references('id')->on('menu_price_groups')->onDelete('cascade');

            $table->index(['menu_price_group_id', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_price_group_items');
    }
};
