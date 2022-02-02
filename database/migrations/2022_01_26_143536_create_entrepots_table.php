<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntrepotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrepots', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ref');
            $table->string('lib');
            $table->string('slug');
            $table->string('email')->nullable();
            $table->string('lieu')->nullable();
            $table->string('adresse')->nullable();
            $table->string('contact')->nullable();
            $table->integer('id_recorder');
            $table->integer('status')->default(1);
            $table->timestamps();

            //Foreign key
            $table->integer('id_entreprise');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entrepots');
    }
}
