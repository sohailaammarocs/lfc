<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookrefereesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bookreferees', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('team_name');
			$table->string('team_type');
			$table->string('opponent_first_name');
			$table->string('opponent_last_name');
			$table->string('opponent_work_phone');
			$table->string('opponent_mobile');
			$table->string('opponent_email_address');
			$table->string('opponent_team_name');
			$table->string('match_gender');
			$table->string('referees');
			$table->string('assistant_refrees');
			$table->string('fixture');
			$table->string('fixture_type');
			$table->string('competition_name');
			$table->string('match_duration');
			$table->time('match_start');
			$table->time('match_end');
			$table->date('fixture_date');
			$table->string('pitch_surface');
			$table->string('venue');
			$table->text('message');
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
		Schema::drop('bookreferees');
	}

}
