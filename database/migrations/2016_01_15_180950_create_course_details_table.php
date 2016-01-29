<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('course_details', function(Blueprint $table)
		{
			$table->string('id', 100);
			$table->string('course_code',10);
			$table->string('offered_by',15);
			$table->string('offered_to',4);
			$table->string('department_code',10);
			$table->timestamps();
			$table->primary('id');
			$table->foreign('course_code')->references('course_code')->on('courses');
			$table->foreign('offered_by')->references('username')->on('users');
			$table->foreign('department_code')->references('code')->on('departments');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('course_details');
	}

}
