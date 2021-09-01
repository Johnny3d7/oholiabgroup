<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bon_commandes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('accord_achat')->default(0);
            $table->string('proforma')->nullable();
            $table->string('proforma_path')->nullable();
            $table->string('date_livraison')->nullable();
            $table->string('lieu_livraison')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();

            //Foreign
            $table->integer('id_fournisseur')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bon_commandes');
    }
}
