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
        Schema::create('lab_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('land_assessment_id')->constrained()->cascadeOnDelete();
            $table->enum('package_type', ['standard', 'complete']);
            
            // Unsur Hara 
            $table->decimal('ph_level', 4, 2)->nullable();
            $table->decimal('c_organic', 5, 2)->nullable();
            $table->decimal('ktk', 8, 2)->nullable(); 
            
            // Makro
            $table->decimal('n_total', 5, 2)->nullable();
            $table->decimal('p_available', 8, 2)->nullable();
            $table->decimal('k_exchange', 5, 2)->nullable();
            $table->decimal('mg_exchange', 5, 2)->nullable();
            $table->decimal('ca_exchange', 5, 2)->nullable();
            $table->decimal('s_sulfur', 5, 2)->nullable();
            
            // Mikro
            $table->decimal('boron', 8, 2)->nullable();
            $table->decimal('zinc', 8, 2)->nullable();
            $table->decimal('copper', 8, 2)->nullable();
            
            $table->text('lab_notes')->nullable();
            $table->date('checked_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_results');
    }
};
