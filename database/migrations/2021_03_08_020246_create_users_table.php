<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->integer('id', true);
			$table->string('firstname')->nullable();
			$table->string('lastname')->nullable();
			$table->string('username', 192);
			$table->string('email', 192);
			$table->string('password');
			$table->string('avatar')->nullable();
            $table->string('identification')->nullable();
            $table->string('criminal_case')->nullable();
			$table->string('phone', 192);
			$table->integer('role_id');
			$table->tinyInteger('type')->comment('1=>Owner 2=>Company');
			$table->boolean('statut')->default(1);
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
		Schema::drop('users');
	}

}
