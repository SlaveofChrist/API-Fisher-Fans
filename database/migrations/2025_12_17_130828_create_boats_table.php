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
        Schema::create('boats', function (Blueprint $table) {
            $table->id('idBoat');
            // Informations textuelles
            $table->string('name');
            $table->text('description');
            $table->string('brand');
            $table->integer('manufacturingYear');
            $table->string('photoUrl')->nullable();
            $table->string('homePort');
            
            // Enums (Permis, Type de bateau, Moteur)
            /* $table->enum('permitType', ['COTIER', 'FLUVIAL'])->default('COTIER');
            $table->enum('boatType', ['OPEN', 'CABINE', 'CATAMARAN', 'VOILIER', 'JETSKI', 'CANOE'])->default('OPEN');
            $table->enum('engineType', ['DIESEL', 'ESSENCE', 'AUCUN'])->default('DIESEL'); */

            $table->string('permitType')->default('COTIER');
            $table->string('boatType')->default('OPEN');
            $table->string('engineType')->default('DIESEL');
            
            // Équipements (Tableau stocké en JSON)
            $table->json('equipments')->default("{'sondeur','vivier'}"); 
            // Valeurs numériques
            $table->decimal('depositAmount', 10, 2); // Caution
            $table->integer('maxCapacity')->default(5);
            $table->integer('numberOfBeds')->default(2);
            $table->decimal('enginePower', 8, 2); // Puissance moteur
            
            // Coordonnées GPS (Précision standard pour latitude/longitude)
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            
            // Relation avec le propriétaire (User)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boats');
    }
};
