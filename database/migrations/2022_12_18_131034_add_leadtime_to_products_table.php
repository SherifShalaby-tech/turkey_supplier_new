<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLeadtimeToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // $table->string('colorName')->nullable();
            // $table->string('sizeName')->nullable();
            // $table->integer('qty')->nullable();
            // $table->integer('leadtime_price')->nullable();
            // $table->integer('leadtime_qty')->nullable();
            // $table->integer('days')->nullable();
            // $table->foreignId('product_id')->constrained()->cascadeOnDelete();

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
