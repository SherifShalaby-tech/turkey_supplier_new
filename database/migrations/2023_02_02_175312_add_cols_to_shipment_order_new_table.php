<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToShipmentOrderNewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipment_orders_new', function (Blueprint $table) {
            $table->enum('weightunit', ['kg','pound','ounce','g'])->default('kg');
            $table->double('weight')->nullable();
            $table->integer('package_no')->nullable();
            $table->string('destination')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipment_orders_new', function (Blueprint $table) {
            //
        });
    }
}
