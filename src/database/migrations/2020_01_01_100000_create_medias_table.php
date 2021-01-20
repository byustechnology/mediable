<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mediable', function(Blueprint $table)
		{
			$table->id('id');
			$table->string('name');
			$table->string('uri');
			$table->string('url');
			$table->string('storage');
			$table->string('path');
			$table->string('extension');
			$table->string('file');
			$table->string('original_file');
			$table->string('mime');
            $table->unsignedBigInteger('mediable_id');
            $table->string('mediable_type');
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
		Schema::drop('mediable');
	}

}
