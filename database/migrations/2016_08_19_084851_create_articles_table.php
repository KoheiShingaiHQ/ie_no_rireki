<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('date');
            $table->string('provider', 50);
            $table->string('title', 500);
            $table->string('url', 255);
            $table->dateTime('posted');
            $table->string('hash', 30);
            $table->integer('views')->default(0);
            $table->integer('shares')->default(0);
            $table->integer('favorites')->default(0);
            $table->timestamps();
            $table->unique('url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
    }
}
