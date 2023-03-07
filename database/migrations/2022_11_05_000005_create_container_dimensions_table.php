<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContainerDimensionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('container_dimensions', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('shipment_service_id')->nullable();
            $table->foreign('shipment_service_id')->references('id')->on('shipment_services')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
		Schema::drop('container_dimensions');
	}

}
