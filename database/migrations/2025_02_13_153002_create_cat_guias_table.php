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
        Schema::create('cat_guias', function (Blueprint $table) {
            $table->id('guia_id');
            $table->enum('guia_act',['0','1'])->default('1');
            $table->string('guia_name')->unique()->key();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_guias');
    }
};
