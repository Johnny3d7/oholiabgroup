<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_devices', function (Blueprint $table) {
            $table->id();
            $table->string("uuid",255);
	 	 	$table->string("reference",255)->nullable();
	 	 	$table->string("libelle",255);
	 	 	$table->string("image",255)->nullable();
	 	 	$table->text("description")->nullable();
	 	 	$table->text("observations")->nullable();
	 	 	$table->integer("created_by")->nullable();
	 	 	$table->integer("updated_by")->nullable();
	 	 	$table->integer("deleted_by")->nullable();
	 	 	$table->softDeletes();
            $table->timestamps();
        });

        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string("uuid",255);
	 	 	$table->string("reference",255)->nullable();
	 	 	$table->string("libelle",255);
	 	 	$table->date("date_acquisition")->nullable();
	 	 	$table->text("description")->nullable();
	 	 	$table->text("observations")->nullable();
	 	 	$table->integer("created_by")->nullable();
	 	 	$table->integer("updated_by")->nullable();
	 	 	$table->integer("deleted_by")->nullable();
	 	 	$table->unsignedBigInteger("id_types")->nullable();
            $table->foreign('id_types')->references('id')->on('type_devices')->onDelete('cascade');
	 	 	$table->softDeletes();
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
        Schema::dropIfExists('type_devices');

        Schema::dropIfExists('devices');
    }
}
