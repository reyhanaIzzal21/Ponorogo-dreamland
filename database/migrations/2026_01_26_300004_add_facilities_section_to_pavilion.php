<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Step 1: Drop the enum constraint and recreate with new value
        // For SQLite/MySQL compatibility, we alter the column
        Schema::table('pavilion_sections', function (Blueprint $table) {
            $table->string('section_type_new')->nullable()->after('id');
            $table->string('image_path')->nullable()->after('extra_data');
        });

        // Copy existing data
        DB::table('pavilion_sections')->update([
            'section_type_new' => DB::raw('section_type'),
        ]);

        // Drop old column and rename new
        Schema::table('pavilion_sections', function (Blueprint $table) {
            $table->dropColumn('section_type');
        });

        Schema::table('pavilion_sections', function (Blueprint $table) {
            $table->renameColumn('section_type_new', 'section_type');
        });

        // Make section_type not nullable and add unique constraint
        Schema::table('pavilion_sections', function (Blueprint $table) {
            $table->string('section_type')->nullable(false)->change();
            $table->unique('section_type');
        });

        // Step 2: Migrate facilities data from hero section to new facilities section
        $heroSection = DB::table('pavilion_sections')
            ->where('section_type', 'hero')
            ->first();

        if ($heroSection) {
            $extraData = json_decode($heroSection->extra_data, true) ?? [];

            // Create facilities section with data from hero's extra_data
            $facilitiesSectionId = \Illuminate\Support\Str::uuid()->toString();

            $facilitiesImagePath = $extraData['facilities_image'] ?? null;

            DB::table('pavilion_sections')->insert([
                'id' => $facilitiesSectionId,
                'section_type' => 'facilities',
                'title' => $extraData['facilities_title'] ?? 'Segala yang Anda Butuhkan',
                'description' => $extraData['facilities_description'] ?? 'Kami memahami bahwa kelancaran acara bergantung pada fasilitas pendukung. Paket sewa Pendopo sudah termasuk:',
                'image_path' => $facilitiesImagePath,
                'sort_order' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Remove facilities data from hero's extra_data
            unset($extraData['facilities_title']);
            unset($extraData['facilities_description']);
            unset($extraData['facilities_image']);

            DB::table('pavilion_sections')
                ->where('id', $heroSection->id)
                ->update(['extra_data' => json_encode($extraData)]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Get facilities section data
        $facilitiesSection = DB::table('pavilion_sections')
            ->where('section_type', 'facilities')
            ->first();

        if ($facilitiesSection) {
            // Move data back to hero's extra_data
            $heroSection = DB::table('pavilion_sections')
                ->where('section_type', 'hero')
                ->first();

            if ($heroSection) {
                $extraData = json_decode($heroSection->extra_data, true) ?? [];
                $extraData['facilities_title'] = $facilitiesSection->title;
                $extraData['facilities_description'] = $facilitiesSection->description;
                $extraData['facilities_image'] = $facilitiesSection->image_path;

                DB::table('pavilion_sections')
                    ->where('id', $heroSection->id)
                    ->update(['extra_data' => json_encode($extraData)]);
            }

            // Delete facilities section
            DB::table('pavilion_sections')
                ->where('section_type', 'facilities')
                ->delete();
        }

        // Remove image_path column
        Schema::table('pavilion_sections', function (Blueprint $table) {
            $table->dropColumn('image_path');
        });

        // Note: We cannot easily restore enum constraint, keeping as string
    }
};
