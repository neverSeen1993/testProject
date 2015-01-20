<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupTasks extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groupTasks', function($table)
        {
            $table->increments('id');
            $table->integer('group_id');
            $table->integer('task_id');
            $table->integer('deadline');
            $table->integer('periodicity_id');
            $table->integer('timeIndex');
            $table->integer('accumulation');
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
        Schema::drop('groupTasks');
    }

}
