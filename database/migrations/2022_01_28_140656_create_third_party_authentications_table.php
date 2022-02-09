<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThirdPartyAuthenticationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('third_party_authentications', function (Blueprint $table) {
            $table->id();
            $table->string('app_id',50)->nullable(false)->comment('The id of the social network.');
            $table->string('name',191)->nullable(false)->comment('The name of the social network.');
            $table->string('app_token',191)->nullable(false)->comment('The token of the social network.');
            $table->integer('user_id')->nullable(false)->comment('The id of the owner of the social network.');
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
        Schema::dropIfExists('third_party_authentications');
    }
}
