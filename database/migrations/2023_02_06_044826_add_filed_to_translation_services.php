<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFiledToTranslationServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('translation_services', function (Blueprint $table) {
            $table->string('country_code')->nullable();
            $table->string('email')->nullable();
            $table->integer('qty')->nullable();
            $table->string('supply_period')->nullable();
            $table->foreignId('product_id')->nullable()->constrained('products')->cascadeOnDelete();
            $table->string('company_email')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('translation_services', function (Blueprint $table) {
            $table->dropColumn('country_code');
            $table->dropColumn('email');
            $table->dropColumn('qty');
            $table->dropColumn('supply_period');
            $table->dropColumn('product_id');
            $table->dropColumn('company_email');
            $table->dropColumn('company_phone');
            $table->dropColumn('company_address');
        });
    }
}
