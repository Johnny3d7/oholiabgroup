<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLigneCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligne_commandes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('commande_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('qte');
            $table->integer('prix');
            $table->integer('status')->default(1);
            
            $table->foreign('commande_id')->references('id')->on('commandes')
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
        Schema::table('ligne_commandes', function (Blueprint $table) {
            $table->dropForeign('ligne_commandes_commande_id_foreign');
            $table->dropForeign('ligne_commandes_product_id_foreign');
        });

        Schema::dropIfExists('ligne_commandes');
    }
}
