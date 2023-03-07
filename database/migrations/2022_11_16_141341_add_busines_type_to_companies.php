<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBusinesTypeToCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->text('images')->nullable();
            $table->string('business_type')->nullable();
            $table->string('country_Region')->nullable();
            $table->text('main_products')->nullable();
            $table->string('total_employee')->nullable();
            $table->string('major_clients')->nullable();
            $table->text('certifications')->nullable();
            $table->text('product_certifications')->nullable();
            $table->string('patents')->nullable();
            $table->text('trademarks')->nullable();
            $table->text('main_markets')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('business_type');
            $table->dropColumn('country_Region');
            $table->dropColumn('main_products');
            $table->dropColumn('total_employee');
            $table->dropColumn('major_clients');
            $table->dropColumn('certifications');
            $table->dropColumn('product_certifications');
            $table->dropColumn('patents');
            $table->dropColumn('trademarks');
            $table->dropColumn('main_markets');
        });
    }
}
