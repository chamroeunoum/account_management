<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatrasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matras', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('number');
			$table->text('title');
			$table->text('meaning');
			$table->integer('book_id');
			$table->integer('kunty_id')->nullable()->default(0);
			$table->integer('matika_id')->nullable()->default(0);
			$table->integer('chapter_id')->nullable()->default(0);
			$table->integer('part_id')->nullable()->default(0);
			$table->integer('section_id')->nullable()->default(0);
			$table->integer('created_by');
			$table->integer('updated_by');
			$table->integer('active')->nullable()->default(0);
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
		Schema::drop('matras');
	}

}
