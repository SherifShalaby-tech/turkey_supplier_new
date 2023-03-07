<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutnewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aboutnews', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('subject')->nullable();
            $table->longText('translation')->nullable();
            $table->unsignedTinyInteger('status')->default(0);
            $table->string('image')->nullable();
            $table->string('admin_add')->nullable();
            $table->string('admin_edit')->nullable();
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
        Schema::dropIfExists('aboutnews');
    }
}
