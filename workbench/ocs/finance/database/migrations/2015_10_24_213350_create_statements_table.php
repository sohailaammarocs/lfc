<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('statements', function(Blueprint $table)
		{
			$table->increments('id');
			$table->date('Date');
			$table->longText('Description');
			$table->text('Money_in');
			$table->text('Money_out');
			$table->text('Balance');
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
		Schema::drop('statements');
	}

}
