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
        Schema::create('about_page_contents', function (Blueprint $table) {
            $table->id();

            // Hero Section
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->string('hero_blob_image')->nullable(); // Blob shape image

            // Story/History Sections
            $table->string('story_1_title')->nullable();
            $table->text('story_1_description')->nullable();
            $table->string('story_1_image')->nullable();

            $table->string('story_2_title')->nullable();
            $table->text('story_2_description')->nullable();
            $table->string('story_2_image')->nullable();

            $table->string('story_3_title')->nullable();
            $table->text('story_3_description')->nullable();
            $table->string('story_3_image')->nullable();

            // Values Cards
            $table->string('value_1_title')->nullable(); // Otentik
            $table->text('value_1_description')->nullable();

            $table->string('value_2_title')->nullable(); // Inovatif
            $table->text('value_2_description')->nullable();

            $table->string('value_3_title')->nullable(); // Kehangatan
            $table->text('value_3_description')->nullable();

            // Stats
            $table->string('stat_1_label')->nullable();
            $table->string('stat_1_value')->nullable();

            $table->string('stat_2_label')->nullable();
            $table->string('stat_2_value')->nullable();

            $table->string('stat_3_label')->nullable();
            $table->string('stat_3_value')->nullable();

            // Founder Quote
            $table->text('founder_quote')->nullable();
            $table->string('founder_job')->nullable();
            $table->string('founder_sub_job')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_page_contents');
    }
};
