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
        // 1. Pool Contents (Hero Section & General Settings)
        Schema::create('pool_contents', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->nullable();
            $table->string('main_headline')->nullable();
            $table->string('blue_headline')->nullable();
            $table->string('sub_headline')->nullable();
            $table->date('launch_date')->nullable();
            $table->string('teaser_background')->nullable();
            $table->timestamps();
        });

        // 2. Pool Sneak Peeks (Fixed Slots 1-4)
        Schema::create('pool_sneak_peeks', function (Blueprint $table) {
            $table->id();
            $table->integer('slot_number')->unique();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();
            $table->string('icon')->nullable();
            $table->timestamps();
        });

        // 3. Pool Timeline Stages
        Schema::create('pool_timeline_stages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('period')->nullable();
            $table->enum('status', ['planned', 'on_progress', 'done'])->default('planned');
            $table->integer('progress_percentage')->default(0);
            $table->text('description')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // 4. Pool Timeline Photos (Max 3 per stage)
        Schema::create('pool_timeline_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pool_timeline_stage_id')->constrained('pool_timeline_stages')->onDelete('cascade');
            $table->string('image_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pool_timeline_photos');
        Schema::dropIfExists('pool_timeline_stages');
        Schema::dropIfExists('pool_sneak_peeks');
        Schema::dropIfExists('pool_contents');
    }
};
