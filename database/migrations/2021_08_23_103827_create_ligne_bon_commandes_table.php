<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLigneBonCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligne_bon_commandes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('bon_commande_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('qte');
            $table->integer('prix');
            $table->integer('status')->default(1);
            
            $table->foreign('bon_commande_id')->references('id')->on('bon_commandes')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('product_id')->references('id')->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::table('ligne_bon_commandes', function (Blueprint $table) {
            $table->dropForeign('ligne_bon_commandes_bon_commande_id_foreign');
            $table->dropForeign('ligne_bon_commandes_product_id_foreign');
        });

        Schema::dropIfExists('ligne_bon_commandes');
    }
}
