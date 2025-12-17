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
        Schema::create('fishing_log_pages', function (Blueprint $table) {
            $table->id('idFishingLogPage');
            // Clé étrangère vers le carnet de pêche parent
            $table->foreignId('fishing_log_id')
                ->constrained('fishing_logs','idFishingLog')
                ->onDelete('cascade');
            
            // Détails de la prise
            $table->string('photoUrl')->nullable();
            $table->text('comment')->nullable();
            $table->decimal('sizeCm', 6, 2);   // ex: 120.50 cm
            $table->decimal('weightKg', 6, 2); // ex: 045.20 kg
            $table->string('fishingLocation');
            $table->date('fishingDate');
            $table->boolean('released')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fishing_log_pages');
    }
};
