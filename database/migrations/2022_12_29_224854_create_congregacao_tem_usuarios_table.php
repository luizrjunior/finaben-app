<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCongregacaoTemUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('congregacoes_tem_usuarios', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('congregacao_id')->unsigned();
            $table->foreign('congregacao_id')
                ->references('id')
                ->on('congregacoes')
                ->onDelete('cascade');
            $table->integer('usuario_id')->unsigned();
            $table->foreign('usuario_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->primary(['congregacao_id', 'usuario_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('congregacoes_tem_usuarios');
    }
}
