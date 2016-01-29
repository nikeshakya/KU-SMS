<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeTablesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('time_tables', function(Blueprint $table)
		{
			$table->string('class_id',40);
			$table->string('course_code',30);
			$table->float('stime');
			$table->float('etime');
			$table->string('day',10);
			$table->string('department_code',10);
			$table->tinyInteger('room');
			$table->timestamps();
			$table->primary('class_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('time_tables');
	}

}
