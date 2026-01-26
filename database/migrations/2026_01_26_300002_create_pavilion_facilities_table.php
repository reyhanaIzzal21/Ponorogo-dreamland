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
        Schema::create('pavilion_facilities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('icon')->default('✨');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('icon_bg_color')->default('bg-green-50');
            $table->string('icon_color')->default('text-primary');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pavilion_facilities');
    }
};
