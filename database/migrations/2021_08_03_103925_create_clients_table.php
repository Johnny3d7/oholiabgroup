<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codeclient')->nullable();
            $table->string('nom');
            $table->string('category');
            $table->string('statut');
            $table->string('slug');
            $table->string('email')->unique()->nullable();
            $table->string('adresse');
            $table->string('contact')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();

            //Foreign_key
            $table->integer('id_type_client')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
