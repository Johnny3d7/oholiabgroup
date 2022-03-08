<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('num', 45);
            $table->string('slug', 250)->nullable();
            $table->integer('duree_validite');
            $table->datetime('date_fin');

            $table->integer('id_recorder')->unsigned();
            $table->integer('id_client')->unsigned();
            $table->integer('id_entreprise')->unsigned();
        
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devis');
    }
}

