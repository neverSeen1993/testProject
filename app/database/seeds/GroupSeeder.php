<?php

class GroupSeeder extends Seeder
{

    public function run()
    {
        DB::table('groups')->delete();

        DB::table('groups')->insert(array(
            array('id' => 1, 'name' => 'Group 1'),
            array('id' => 2, 'name' => 'Group 2'),
            array('id' => 3, 'name' => 'Group 3'),
            array('id' => 4, 'name' => 'Group 4'),
            array('id' => 5, 'name' => 'Group 5'),
            array('id' => 6, 'name' => 'Group 6')
        ));
    }

}