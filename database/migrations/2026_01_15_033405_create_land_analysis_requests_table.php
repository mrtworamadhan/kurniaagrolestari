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
        Schema::create('land_analysis_requests', function (Blueprint $table) {
            $table->id();
            $table->string('owner_name');
            $table->string('phone'); 
            $table->string('email');
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            
            // Data Kebun
            $table->string('location');
            $table->double('area_size'); 
            $table->string('plant_type');
            $table->integer('plant_age');
            $table->string('coordinates')->nullable();
            $table->foreignId('soil_type_id')->nullable()->constrained()->cascadeOnDelete();

            // Masalah
            $table->string('plant_variety')->nullable();
            $table->string('topography')->nullable();
            $table->text('current_condition')->nullable(); 
            $table->text('fertilizer_history')->nullable();
            $table->string('bunch_weight')->nullable();
            
            // Target
            $table->string('current_yield')->nullable();
            $table->string('target_yield')->nullable();

            $table->json('photos')->nullable();
            $table->string('video_url')->nullable(); 
            
            $table->string('status')->default('pending'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('land_analysis_requests');
    }
};
