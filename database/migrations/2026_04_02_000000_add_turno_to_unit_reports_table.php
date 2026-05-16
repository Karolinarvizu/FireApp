<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTurnoToUnitReportsTable extends Migration
{
    public function up()
    {
        Schema::table('unit_reports', function (Blueprint $table) {
            $table->string('entrega_turno')->nullable()->after('gas_diesel_notes');
            $table->string('recepcion_turno')->nullable()->after('entrega_turno');
        });
    }

    public function down()
    {
        Schema::table('unit_reports', function (Blueprint $table) {
            $table->dropColumn(['entrega_turno', 'recepcion_turno']);
        });
    }
}