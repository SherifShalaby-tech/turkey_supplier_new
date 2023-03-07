<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradeShowTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trade_show', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->id();
            $table->string('title');
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->string('details');
            $table->timestamps(6);
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
		Schema::drop('trade_show');
	}

}
