<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('settings', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->integer('id', true);
			$table->integer('currency_id')->nullable()->index('currency_id');
			$table->string('company_name');
			$table->string('company_phone');
			$table->string('company_address');
            $table->string('email');
            $table->string('city');
            $table->string('facebook');
            $table->string('linkedin');
            $table->string('phone');
            $table->string('logo')->nullable();
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
		Schema::drop('settings');
	}

}
