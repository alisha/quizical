<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('courses', function($table) {
			$table->increments('id');
			$table->string('name');
			$table->string('block', 1);
			$table->integer('number_of_freshmen');
			$table->integer('number_of_sophomores');
			$table->integer('number_of_juniors');
			$table->integer('number_of_seniors');
			$table->enum('department', array('Math', 'Science', 'English', 'History/Social Studes', 'Foreign Languages', 'Guidance and Support', 'Health and Wellness', 'Arts', 'Other'));
			$table->enum('level', array('Foundations', 'College Prep', 'Honors', 'Advanced Placement'));
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
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
		Schema::drop('courses');
	}

}
