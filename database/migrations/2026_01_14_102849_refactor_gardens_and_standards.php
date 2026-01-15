<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gardens', function (Blueprint $table) {
            $table->dropColumn('soil_type'); 
            $table->foreignId('soil_type_id')->nullable()->constrained('soil_types')->nullOnDelete();
        });

        Schema::table('soil_standards', function (Blueprint $table) {
            $table->dropColumn('soil_type');
            $table->foreignId('soil_type_id')->nullable()->constrained('soil_types')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('gardens', function (Blueprint $table) {
            $table->dropForeign(['soil_type_id']);
            $table->dropColumn('soil_type_id');
            $table->string('soil_type')->nullable();
        });
        
        Schema::table('soil_standards', function (Blueprint $table) {
            $table->dropForeign(['soil_type_id']);
            $table->dropColumn('soil_type_id');
            $table->string('soil_type')->nullable();
        });
    }
};