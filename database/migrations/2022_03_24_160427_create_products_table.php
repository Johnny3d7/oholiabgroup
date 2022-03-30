<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class createProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('uuid',100);
			$table->string('reference',100);
			$table->string('name',100);
			$table->string('reference_achat',100)->nullable();
			$table->text('description')->nullable();
			$table->text('image')->nullable();
			$table->string('type',100);
			$table->string('nature',100);
			$table->string('unite',100);
            
			$table->unsignedBigInteger('id_categories')->nullable();
            $table->foreign('id_categories')->references('id')->on('categories')->onDelete('cascade');
			$table->unsignedBigInteger('id_entreprises')->nullable();
            $table->foreign('id_entreprises')->references('id')->on('entreprises')->onDelete('cascade');

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
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
        Schema::dropIfExists('products');
    }
}
