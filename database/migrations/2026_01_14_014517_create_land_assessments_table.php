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
        Schema::create('land_assessments', function (Blueprint $table) {
            
            $table->id();
            $table->foreignId('garden_id')->constrained()->cascadeOnDelete();
            $table->string('status')->default('pending'); 

            // Data Kuesioner
            $table->string('plant_variety')->nullable(); 
            $table->string('topography')->nullable(); 
            $table->text('current_condition')->nullable(); 
            $table->text('fertilizer_history')->nullable();
            $table->string('bunch_weight')->nullable();
            $table->string('current_yield')->nullable();
            $table->string('target_yield')->nullable();
            
            // Bukti Visual
            $table->json('photos')->nullable();
            $table->string('video_url')->nullable(); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('land_assessments');
    }
};
