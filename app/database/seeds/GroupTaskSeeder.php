<?php

class GroupTaskSeeder extends Seeder
{

    public function run()
    {
        DB::table('groupTasks')->delete();

        DB::table('groupTasks')->insert(array(
            array('group_id' => 1, 'task_id' => 1, 'deadline' => 40, 'periodicity_id' => 1, 'timeIndex' => 1, 'accumulation' => 1),
            array('group_id' => 1, 'task_id' => 2, 'deadline' => 20, 'periodicity_id' => 2, 'timeIndex' => 1, 'accumulation' => 1),
            array('group_id' => 1, 'task_id' => 2, 'deadline' => 20, 'periodicity_id' => 3, 'timeIndex' => 1, 'accumulation' => 1),
            array('group_id' => 1, 'task_id' => 3, 'deadline' => 20, 'periodicity_id' => 3, 'timeIndex' => 2, 'accumulation' => 1),
            array('group_id' => 2, 'task_id' => 1, 'deadline' => 40, 'periodicity_id' => 1, 'timeIndex' => 1, 'accumulation' => 1),
            array('group_id' => 2, 'task_id' => 2, 'deadline' => 20, 'periodicity_id' => 2, 'timeIndex' => 1, 'accumulation' => 1),
            array('group_id' => 2, 'task_id' => 2, 'deadline' => 20, 'periodicity_id' => 3, 'timeIndex' => 1, 'accumulation' => 1),
            array('group_id' => 2, 'task_id' => 3, 'deadline' => 20, 'periodicity_id' => 3, 'timeIndex' => 2, 'accumulation' => 1),
            array('group_id' => 3, 'task_id' => 1, 'deadline' => 40, 'periodicity_id' => 2, 'timeIndex' => 1, 'accumulation' => 2),
            array('group_id' => 3, 'task_id' => 2, 'deadline' => 20, 'periodicity_id' => 2, 'timeIndex' => 1, 'accumulation' => 1),
            array('group_id' => 3, 'task_id' => 2, 'deadline' => 20, 'periodicity_id' => 3, 'timeIndex' => 1, 'accumulation' => 1),
            array('group_id' => 3, 'task_id' => 3, 'deadline' => 50, 'periodicity_id' => 2, 'timeIndex' => 1, 'accumulation' => 1),
            array('group_id' => 5, 'task_id' => 1, 'deadline' => 40, 'periodicity_id' => 2, 'timeIndex' => 1, 'accumulation' => 2),
            array('group_id' => 5, 'task_id' => 2, 'deadline' => 20, 'periodicity_id' => 2, 'timeIndex' => 1, 'accumulation' => 1),
            array('group_id' => 5, 'task_id' => 2, 'deadline' => 20, 'periodicity_id' => 3, 'timeIndex' => 1, 'accumulation' => 1),
            array('group_id' => 5, 'task_id' => 3, 'deadline' => 50, 'periodicity_id' => 2, 'timeIndex' => 1, 'accumulation' => 1),
            array('group_id' => 4, 'task_id' => 1, 'deadline' => 40, 'periodicity_id' => 2, 'timeIndex' => 1, 'accumulation' => 1),
            array('group_id' => 4, 'task_id' => 3, 'deadline' => 50, 'periodicity_id' => 2, 'timeIndex' => 1, 'accumulation' => 1),
            array('group_id' => 6, 'task_id' => 1, 'deadline' => 40, 'periodicity_id' => 2, 'timeIndex' => 1, 'accumulation' => 1),
            array('group_id' => 6, 'task_id' => 3, 'deadline' => 50, 'periodicity_id' => 2, 'timeIndex' => 1, 'accumulation' => 1),
        ));
    }

}