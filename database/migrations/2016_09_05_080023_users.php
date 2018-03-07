<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 30);
            $table->string('passwd', 30)->nullable();
            $table->string('last_name', 30)->nullable();
            $table->string('first_name', 30)->nullable();
            $table->string('first_kana', 30)->nullable();
            $table->string('last_kana', 30)->nullable();
            $table->integer('division_id')->default('4');
            $table->integer('affiliation_id')->default('15');
            $table->integer('department_id')->default('26');
            $table->timestamps();
            $table->unique('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
