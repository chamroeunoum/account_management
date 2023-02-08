<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatikasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matikas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('title');
			$table->string('number', 191);
			$table->integer('book_id');
			$table->integer('kunty_id');
			$table->integer('created_by');
			$table->integer('updated_by');
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
		Schema::drop('matikas');
	}

}
