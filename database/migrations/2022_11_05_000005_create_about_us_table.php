<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutUsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('about_us', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
            $table->id();
            $table->text('about_us')->nullable();
            $table->text('services')->nullable();
            $table->text('shipping_products')->nullable();
            $table->text('mediation')->nullable();
            $table->integer('status');
            $table->integer('user_id')->index('user_id')->nullable();
            $table->foreign('user_id', 'user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
		Schema::drop('about_us');
	}

}
