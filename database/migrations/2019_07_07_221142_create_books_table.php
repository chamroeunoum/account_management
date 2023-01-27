<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBooksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('books', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('title', 65535)->comment('The title of the book');
			$table->text('description', 65535)->nullable();
			$table->string('color', 191)->default('#FAFAFA')->comment('The color of the book');
			$table->string('cover', 191)->nullable()->comment('The cover of the book');
			$table->integer('complete')->default(0)->comment('the status identify that the book has been finished the data entry or not');
			$table->integer('active')->default(0)->comment('the status identify that the book has been published');
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->string('pdf', 191)->nullable();
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
		Schema::drop('books');
	}

}
