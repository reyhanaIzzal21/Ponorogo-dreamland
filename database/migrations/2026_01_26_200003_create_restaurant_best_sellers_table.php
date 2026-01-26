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
        Schema::create('restaurant_best_sellers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('menu_item_id')
                ->constrained('menu_items')
                ->cascadeOnDelete();
            $table->tinyInteger('slot_number')->unsigned();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique('slot_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurant_best_sellers');
    }
};
