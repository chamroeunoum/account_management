<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableSubscription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->float('amount')->default(0);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            if (
                Schema::hasColumn('subscriptions', 'amount') &&
                Schema::hasColumn('subscriptions', 'user_id') &&
                Schema::hasColumn('subscriptions', 'start_date') &&
                Schema::hasColumn('subscriptions', 'end_date')
            ) {
                $table->dropColumn(['amount','user_id','start_date','end_date']);
            }
        });
    }
}
