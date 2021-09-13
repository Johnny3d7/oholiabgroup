<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFournisseursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codefour')->nullable();
            $table->string('slug');
            $table->string('nom');
            $table->string('email')->unique();
            $table->string('contact')->unique();
            $table->string('adresse')->nullable();
            $table->string('ncc')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();

            //Foreign_key
            $table->integer('id_type_fournisseur')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fournisseurs');
    }
}
