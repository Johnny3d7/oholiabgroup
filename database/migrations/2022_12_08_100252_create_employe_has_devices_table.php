<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeHasDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employe_has_devices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_devices")->nullable();
	 	 	$table->unsignedBigInteger("id_employes")->nullable();
	 	 	$table->date("date_cession")->nullable();
            // $table->foreign('id_devices')->references('id')->on('devices')->onDelete('cascade');
            $table->foreign('id_employes')->references('id')->on('employes')->onDelete('cascade');
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
        Schema::dropIfExists('employe_has_devices');
    }
}
