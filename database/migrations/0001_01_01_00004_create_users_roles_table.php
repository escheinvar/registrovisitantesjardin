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
        Schema::create('users_roles', function (Blueprint $table) {
            $table->id('rol_id');
            $table->enum('rol_act',['0','1'])->default('1');
            $table->string('rol_email');
            $table->foreign('rol_email')->references('email')->on('users')->onDelete('cascade')->constrained('users','email');
            $table->string('rol_rol');
            $table->foreign('rol_rol')->references('crol_rol')->on('cat_roles_user')->onDelete('cascade')->constrained('rol_rol','crol_rol');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_roles');
    }
};
