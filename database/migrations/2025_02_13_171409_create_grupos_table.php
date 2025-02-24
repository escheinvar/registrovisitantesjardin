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
        Schema::create('grupos', function (Blueprint $table) {
            $table->id('gpo_id');
            $table->enum('gpo_cerrado',['0','1'])->default('0');  ##### Indica si el grupo está abierto (0) o ya se cerró (1)
            $table->date('gpo_date');  #### fecha del recorrido
            $table->integer('gpo_num')->default('0');  ##### número consecutivo de recorrido del día

            #$table->foreignId('gpo_cgpoid')->constrained('cat_tipo_gpo','cgpo_id'); ### tipo de grupo
            $table->string('gpo_cgponame');
            $table->foreign('gpo_cgponame')->references('cgpo_name')->on('cat_tipo_gpo')->onDelete('cascade')->constrained('cat_tipo_gpo','cgpo_name');

            #$table->foreignId('gpo_guiaid')->constrained('cat_guias','guia_id');  ### Guia que lleva
            $table->string('gpo_guianame');
            $table->foreign('gpo_guianame')->references('guia_name')->on('cat_guias')->onDelete('cascade')->constrained('cat_guias','guia_name');

            $table->dateTime('gpo_ini_reg');   ### timestamp de inicio de registro
            $table->dateTime('gpo_fin_reg')->nullable(); ##### timestamp de fin de registro

            $table->dateTime('gpo_ini_reco')->nullable();   ### timestamp de inicio de registro
            $table->dateTime('gpo_fin_reco')->nullable(); ##### timestamp de fin de registro

            $table->longText('gpo_notas_reg')->nullable(); ###### notas del registro
            $table->longText('gpo_notas_reco')->nullable(); ##### notas del recorrido

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos');
    }
};
