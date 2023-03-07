<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediationOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mediation_orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->string('company_name')->nullable();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->string('phone');
            $table->string('country_address');
            $table->longText('product_images')->nullable();
            $table->string('product_name')->nullable();
            $table->text('product_desc')->nullable();
            $table->integer('qty');
            $table->string('supply_period')->nullable();
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
        Schema::dropIfExists('mediation_orders');
    }
}
