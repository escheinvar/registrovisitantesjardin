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
        Schema::create('boletos', function (Blueprint $table) {
            $table->id('bol_id');

            $table->foreignId('bol_gpoid')->constrained('grupos','gpo_id');
            #$table->integer('bol_gponumber');

            #$table->string('bol_gponame');
            #$table->foreign('bol_gponame')->references('cgpo_name')->on('cat_tipo_gpo')->onDelete('cascade')->constrained('cat_tipo_gpo','cgpo_name');

            $table->string('bol_bolname');
            $table->foreign('bol_bolname')->references('bol_name')->on('cat_tipo_boleto')->onDelete('cascade')->constrained('cat_tipo_boleto','bol_name');

            $table->integer('bol_cant');
            $table->enum('bol_tipopago',['ef','td','tc','ww'])->default('ef'); ##### tipo de pago: efectivo, tarDeb, tarCred, Internet
            $table->string('bol_mail')->nullable();
            $table->string('bol_notas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boletos');
    }
};
