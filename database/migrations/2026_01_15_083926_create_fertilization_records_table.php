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
        Schema::create('fertilization_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('garden_id')->constrained()->cascadeOnDelete();
            $table->date('fertilization_date');
            $table->string('fertilizer_name');
            $table->decimal('dosage', 8, 2);
            $table->string('unit')->default('Kg/Pokok');
            $table->text('notes')->nullable();
            $table->string('photo_evidence')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fertilization_records');
    }
};
