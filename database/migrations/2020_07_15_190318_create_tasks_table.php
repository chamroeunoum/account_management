<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name')->nullable(false)->comment("name of the task");
            $table->double('duration')->nullable(false)->comment("Duration that the task should be done, measure as hour");
            $table->datetime('start')->nullable(true)->comment('start date of task');
            $table->datetime('end')->nullable(true)->comment('end date of the task');
            $table->double('amount',0,4)->default(0.0)->comment('earning amount from this task');
            $table->double('exchange_rate',0,4)->default(0.0)->comment('exchange rate of the current currency with USD');
            $table->integer('amount_type')->nullale(true)->comment('0: expense, 1: earn');
            $table->integer('created_by')->nullable(true)->comment('id of creator');
            $table->integer('active')->default(0)->comment('status of using record');
            $table->integer('status')->default(0)->comment('0: New, 1: Start, 2: End, 4: Pending, Cancel: 8');
            $table->text('pdfs')->nullable(true)->comment('reference files');
            $table->integer('updated_by')->nullable(true)->comment('Task editor');
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
        Schema::dropIfExists('tasks');
    }
}
