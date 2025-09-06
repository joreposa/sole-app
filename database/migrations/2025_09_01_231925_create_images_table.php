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
        Schema::create('images', function (Blueprint $table) {
            // Esta es la clave primaria principal
            $table->id(); 
            $table->string('url', 75);
            $table->unsignedBigInteger('imageable_id');
            $table->string('imageable_type');
            $table->timestamps();

            // Opcional: añade un índice para mejorar el rendimiento de las consultas
            $table->index(['imageable_id', 'imageable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};