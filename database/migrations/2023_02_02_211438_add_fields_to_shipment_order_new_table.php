<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToShipmentOrderNewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipment_orders_new', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->string('companyname')->nullable();
            $table->string('code')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('country')->nullable();
            $table->string('vendorname')->nullable();
            // $table->string('vendoraddress')->nullable();
            $table->string('vendorphone')->nullable();
            $table->string('vendoremail')->nullable();
            $table->string('file')->nullable();
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
