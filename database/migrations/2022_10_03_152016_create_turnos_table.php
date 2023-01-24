<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turnos', function (Blueprint $table) {
            $table->id();
            $table->string('cod',10)->nullable();
            $table->string('turno',10)->nullable();
            $table->string('documento',50)->nullable();
            $table->string('modulo',100)->nullable();
            $table->timestamps();
        });

        Schema::create('area', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->string('GCC',10)->nullable();
            $table->string('GCME',10)->nullable();
            $table->string('GCN',10)->nullable();
            $table->string('GCOE',10)->nullable();
            $table->string('GRC',10)->nullable();
            $table->string('GEC',10)->nullable();
            $table->string('PCME',10)->nullable();
            $table->string('PCN',10)->nullable();
            $table->string('PCOE',10)->nullable();
            $table->string('PRC',10)->nullable();
            $table->string('PEC',10)->nullable();
            $table->string('PCC',10)->nullable();
            $table->string('GA',10)->nullable();
            $table->string('GAI',10)->nullable();
            $table->string('GAU',10)->nullable();
            $table->string('GER',10)->nullable();
            $table->string('GL',10)->nullable();
            $table->string('GAN',10)->nullable();



        });

        Schema::create('usuarios',function (Blueprint $table){
            $table->bigInteger('id');
            $table->string('usuario',30)->nullable();
            $table->string('password',30)->nullable();
            $table->string('nombre',30)->nullable();
            $table->string('apellido',30)->nullable();
            $table->string('rol',30)->nullable();
            $table->string('taquilla',30)->nullable();
        });

    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('turnos');
    }
};
