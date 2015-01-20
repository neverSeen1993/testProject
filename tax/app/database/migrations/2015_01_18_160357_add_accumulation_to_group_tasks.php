<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAccumulationToGroupTasks extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('groupTasks', function($table)
        {
            $table->integer('accumulation');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('groupTasks', function($table)
        {
            $table->dropColumn('accumulation');
        });
	}

}
