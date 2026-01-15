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
        Schema::create('garden_monitorings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('garden_id')->constrained()->cascadeOnDelete();
            $table->date('monitoring_date');
            
            $table->string('current_yield')->nullable();
            $table->string('frond_count')->nullable();
            $table->string('fruit_weight')->nullable();

            $table->text('visual_condition');
            $table->text('recommendation_status');
            
            $table->json('photos')->nullable();
            
            $table->foreignId('assessor_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('garden_monitorings');
    }
};
