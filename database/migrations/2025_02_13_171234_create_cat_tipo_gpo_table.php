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
        Schema::create('cat_tipo_gpo', function (Blueprint $table) {
            $table->id('cgpo_id');
            $table->enum('cgpo_act',['0','1'])->default('1');
            $table->string('cgpo_name')->unique()->key();
            $table->string('cgpo_describe')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_tipo_gpo');
    }
};
