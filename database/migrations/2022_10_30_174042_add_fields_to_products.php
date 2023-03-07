<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // $table->string('OneToTwoUnit')->nullable();
            // $table->string('GreaterEqualThreeUnit')->nullable();
            // $table->string('Applicable_Industries')->nullable();
            // $table->string('Condition')->nullable();
            // $table->string('Operating_Weight')->nullable();
            // $table->string('Max_Digging_Height')->nullable();
            // $table->string('Machine_Weight')->nullable();
            // $table->string('Rated_Speed')->nullable();
            // $table->string('Power')->nullable();
            $table->string('Place_Origin')->nullable();
            $table->string('Supply_Ability')->nullable();
            $table->string('Packaging')->nullable();
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
            $table->dropColumn('OneToTwoUnit');
            $table->dropColumn('GreaterEqualThreeUnit');
            $table->dropColumn('Applicable_Industries');
            $table->dropColumn('Place_Origin');
            $table->dropColumn('Condition');
            $table->dropColumn('Operating_Weight');
            $table->dropColumn('Max_Digging_Height');
            $table->dropColumn('Machine_Weight');
            $table->dropColumn('Rated_Speed');
            $table->dropColumn('Power');
            $table->dropColumn('Supply_Ability');
            $table->dropColumn('Packaging');
        });
    }
}
