<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslationServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('translation_services', function(Blueprint $table)
		{
			// $table->engine = 'InnoDB';
			$table->id();
			$table->string('name');
			$table->string('companyname')->nullable();
            $table->string('phone')->unique();
//            $table->string('country');
            $table->string('language');
            $table->foreignId('company_id')->nullable()->constrained()->cascadeOnDelete();
            $table->text('notes')->nullable();
			$table->timestamps();
			// $table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('translation_services');
	}

}
