<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLinkToTradeShowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trade_show', function (Blueprint $table) {
            $table->string('linkurl')->nullable();
            $table->string('videourl')->nullable();
            $table->string('admin_add')->nullable();
            $table->string('admin_edit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trade_show', function (Blueprint $table) {
            //
        });
    }
}
