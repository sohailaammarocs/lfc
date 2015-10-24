<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJoincompetitionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('joincompetitions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('team_name');
			$table->string('team_type');
			$table->string('competition_type');
			$table->text('message_box');
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
		Schema::drop('joincompetitions');
	}

}
