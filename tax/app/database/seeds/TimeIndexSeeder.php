<?php

class TimeIndexSeeder extends Seeder
{

    public function run()
    {
        DB::table('timeIndex')->delete();

        DB::table('timeIndex')->insert(array(
            array('id' => 1, 'name' => 'past', 'pointer' => -1),
            array('id' => 2, 'name' => 'current', 'pointer' => 0)
        ));
    }

}