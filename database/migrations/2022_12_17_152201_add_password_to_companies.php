<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPasswordToCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->string('password');
            $table->enum('type',['supplier','company']);
            $table->enum('trade_role',['buyer','seller','both']);
            $table->string('agree')->nullable();
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
            $table->dropColumn('password');
            $table->dropColumn('type');
            $table->dropColumn('trade_role');
            $table->dropColumn('agree');
        });
    }
}
