<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('colaborador')->nullable();
            $table->string('name');
            $table->string('descripcion');
            $table->date('fecha_final');
            $table->integer('estado_id');
            $table->integer('categoria_id');
            $table->integer('comentario_id')->nullable();
            $table->string('archivo_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notas');
    }
}
