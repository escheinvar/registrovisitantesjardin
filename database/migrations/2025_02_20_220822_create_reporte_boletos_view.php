<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::create('reporte_boletos_view', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });
        DB::statement("
            CREATE VIEW reporte_boletos AS (
                SELECT bol_gpoid, bol_bolname,sum(bol_cant) as boletos,
                gpo_cerrado,gpo_date,gpo_cgponame,gpo_guianame

                FROM boletos
                join grupos on bol_gpoid = gpo_id

                group by bol_gpoid,bol_bolname,
                gpo_cerrado,gpo_date,gpo_cgponame,gpo_guianame
            )
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('reporte_boletos_view');
        DB::statement('DROP VIEW IF EXISTS reporte_boletos CASCADE');
    }
};
