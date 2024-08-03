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
        Schema::create('news_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('date');
            $table->json('units'); // Unidades involucradas
            $table->string('address'); // Dirección del servicio
            $table->json('personnel'); // Personal involucrado
            $table->time('start_time'); // Hora de inicio
            $table->time('end_time'); // Hora de finalizado
            $table->text('activities')->nullable(); // Actividades realizadas
            $table->text('others')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_reports');
    }
};
