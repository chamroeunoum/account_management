<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->nullable(false)->comment("The id of the users table");
            $table->string('checkin')->nullable(true)->comment('check in date');
            $table->string('checkout')->nullable(true)->comment('check out date');
            $table->string('latitude')->nullable(true)->comment('latitude of the check in / check out');
            $table->string('longitude')->nullable(true)->comment('longitude of check in / check out');
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
        Schema::dropIfExists('attendents');
    }
}
