<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_details', function(Blueprint $table)
		{
			$table->integer('id');
			$table->string('first_name',20);
			$table->string('middle_name',10);
			$table->string('last_name',20);
			$table->string('email_id',50);
			$table->string('address',50);
			$table->string('department',50);
			$table->string('designation',40);
			$table->primary('id');
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
		Schema::drop('user_details');
	}

}
