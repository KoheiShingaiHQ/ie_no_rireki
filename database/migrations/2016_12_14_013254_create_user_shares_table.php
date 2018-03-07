<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSharesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_shares', function (Blueprint $table) {
            $table->increments('id');
            $table->string('from_user', 30);
            $table->string('to_user', 30);
            $table->string('to_group', 30);
            $table->string('hash', 30);
            $table->integer('date');
            $table->timestamps();
            $table->unique(array('from_user', 'to_user', 'to_group', 'hash'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_shares');
    }
}
