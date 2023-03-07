<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ShipmentOrdersNewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_orders_new', function (Blueprint $table) {
             $table->id();
            //  $table->foreignId('shipment_services_id')->nullable()->constrained()->cascadeOnDelete();
              $table->foreignId('company_id')->nullable()->constrained()->cascadeOnDelete();
              $table->enum('shipment_name', ['air_freight','sea_freight'])->default('air_freight');
              $table->enum('shipment_type', ['FOB','Ex-Factory'])->default('FOB');
              $table->enum('unit', ['cm','m','insh','yard'])->default('cm');
              $table->double('length')->nullable();
              $table->double('width')->nullable();
              $table->double('height')->nullable();
              $table->double('dimensional_weight')->nullable();
              $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipment_orders_new');
    }
}
