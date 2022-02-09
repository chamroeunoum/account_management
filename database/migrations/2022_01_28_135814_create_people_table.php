<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('firstname',191)->nullable(false)->comment('The firstname of the person');
            $table->string('lastname',191)->nullable(false)->comment('The lastname of the person');
            $table->string('gender',10)->default('male')->comment('The gender of the person');
            $table->date('dob')->nullable(true)->comment('The date of birth of the person');
            $table->string('pob',191)->nullable(true)->comment('The place of birth of the person');
            $table->string('picture',191)->nullable(true)->comment('The place of birth of the person');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
