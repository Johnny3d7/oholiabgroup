<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variations', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('datemouv');
            $table->integer('typemouv');
            $table->integer('production');
            $table->integer('qte_entree')->nullable();
            $table->integer('qte_sortie')->nullable();
            $table->text('observation')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();

            //Foreign_key
            $table->integer('id_product')->unsigned();
            $table->integer('id_fournisseur')->unsigned()->nullable();
            $table->integer('id_client')->unsigned()->nullable();
            $table->integer('id_entreprise')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('variations');
    }
}
