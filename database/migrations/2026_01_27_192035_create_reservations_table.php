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
        Schema::create('reservations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('destination_id')->constrained('destinations')->cascadeOnDelete();
            $table->string('user_name');
            $table->string('user_whatsapp');
            $table->date('reservation_date');
            $table->integer('number_of_people');
            $table->string('needs');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->boolean('wa_sent')->default(false);
            $table->timestamp('wa_sent_at')->nullable();
            $table->text('wa_error')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
