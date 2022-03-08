<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLignedevisclientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligne_devis_clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('qte');
            $table->integer('prix');

            $table->integer('id_devis')->unsigned();
            $table->integer('id_product')->unsigned();
        
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
        Schema::dropIfExists('ligne_devis_clients');
    }
}

