<?php

class GroupSeeder extends Seeder
{

    public function run()
    {
        DB::table('groups')->delete();

        DB::table('groups')->insert(array(
            array('id' => 1),
            array('id' => 2),
            array('id' => 3),
            array('id' => 4),
            array('id' => 5),
            array('id' => 6)
        ));
    }

}