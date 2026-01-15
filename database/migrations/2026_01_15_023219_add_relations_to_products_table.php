<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('category')->nullable()->after('slug'); // Contoh: 'Pembenah Tanah', 'Pupuk Majemuk'
        });

        Schema::create('benefits', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->timestamps();
        });

        Schema::create('product_benefit', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('benefit_id')->constrained()->cascadeOnDelete();
        });

        Schema::create('product_soil_type', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('soil_type_id')->constrained()->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_soil_type');
        Schema::dropIfExists('product_benefit');
        Schema::dropIfExists('benefits');
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
};