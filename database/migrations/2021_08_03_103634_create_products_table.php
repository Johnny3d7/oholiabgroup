<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ref')->nullable();
            $table->string('slug');
            $table->string('lib');
            $table->string('description')->nullable();
            $table->integer('price')->nullable();
            $table->integer('stockalert')->default(0);
            $table->integer('stockoptimal')->nullable();
            $table->float('poids')->nullable();
            $table->string('unite_poids')->nullable();
            $table->float('longueur')->nullable();
            $table->float('largeur')->nullable();
            $table->float('hauteur')->nullable();
            $table->string('unite_mesure')->nullable();
            $table->float('volume')->nullable();
            $table->string('unite_volume')->nullable();
            $table->float('liquide')->nullable();
            $table->string('unite_liquide')->nullable();
            $table->integer('status')->default(1);
            $table->string('image')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamps();

            //Foreign_key
            $table->integer('id_product_category')->unsigned()->nullable();
            $table->integer('id_type_product')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
