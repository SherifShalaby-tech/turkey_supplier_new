<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('namear')->nullable();
            $table->string('nameen')->nullable();
            $table->string('nametr')->nullable();
            $table->text('descar')->nullable();
            $table->text('descen')->nullable();
            $table->text('desctr')->nullable();
            $table->string('companyar')->nullable();
            $table->string('companyen')->nullable();
            $table->string('companytr')->nullable();
            $table->string('catar')->nullable();
            $table->string('caten')->nullable();
            $table->string('cattr')->nullable();
            $table->string('subcatar')->nullable();
            $table->string('subcaten')->nullable();
            $table->string('subcattr')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
