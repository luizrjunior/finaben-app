<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLancamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lancamentos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            /**
             * STATUS:
             * 0 - Novo;
             * 1 - Pendente;
             * 2 - Quitado;
             */
            $table->integer('status')->unsigned();
            /**
             * CONGREGACAO FK
            */
            $table->integer('congregacao_id')->unsigned();
            $table->foreign('congregacao_id')
                ->references('id')
                ->on('congregacoes')
                ->onDelete('cascade');
            /**
             * CATEGORIA DE LANÇAMENTO FK
            */
            $table->integer('categoria_lancamento_id')->unsigned()->nullable();
            $table->foreign('categoria_lancamento_id')
                ->references('id')
                ->on('categorias_lancamentos')
                ->onDelete('cascade');
            /**
             * TIPO DE LANÇAMENTO:
             * E - ENTRADA;
             * S - SAÍDA;
             */
            $table->string('tipo', 1);
            $table->date('data');
            $table->decimal('valor',12,2);
            $table->string('titulo')->nullable();
            $table->text('url_comprovante')->nullable();
            $table->text('observacao');
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
        Schema::dropIfExists('lancamentos');
    }
}
