<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->double('total_price');
            $table->date('date')->nullable();
            $table->string('order_number', 192)->nullable();
            $table->boolean('is_pos')->nullable()->default(0);
            $table->integer('client_id')->nullable();
            $table->integer('warehouse_id')->nullable();
            $table->float('tax_rate', 10, 0)->nullable()->default(0);
            $table->float('TaxNet', 10, 0)->nullable()->default(0);
            $table->float('discount', 10, 0)->nullable()->default(0);
            $table->float('shipping', 10, 0)->nullable()->default(0);
            $table->float('GrandTotal', 10, 0)->default(0)->nullable();
            $table->float('paid_amount', 10, 0)->default(0)->nullable();
            $table->string('payment_statut', 192)->nullable();
            $table->string('status')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('sales');
    }
}
