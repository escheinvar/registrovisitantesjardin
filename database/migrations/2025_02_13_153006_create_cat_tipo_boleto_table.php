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
        Schema::create('cat_tipo_boleto', function (Blueprint $table) {
            $table->id('bol_id');
            $table->enum('bol_act',['0','1'])->default('1');
            $table->enum('bol_tipo',['c','d','g']); ###### completo, descuento, gratuito            $table->string('bol_name'); #### Nacional, Intetnacional, Adulto mayor, Menor de 16, Maestro, Estudiante, Discapacidad
            $table->string('bol_name')->unique()->key();            ##### nombre del boleto
            $table->decimal('bol_costo',6,2)->default('0.0');
            $table->string('bol_explica')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_tipo_boleto');
    }
};
