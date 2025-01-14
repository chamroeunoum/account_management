<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sections', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('number');
			$table->text('title');
			$table->integer('book_id');
			$table->integer('kunty_id');
			$table->integer('matika_id');
			$table->integer('chapter_id');
			$table->integer('part_id');
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
		Schema::drop('sections');
	}

}
