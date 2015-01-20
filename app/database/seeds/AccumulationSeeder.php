<?php

class AccumulationSeeder extends Seeder
{

    public function run()
    {
        DB::table('accumulation')->delete();

        DB::table('accumulation')->insert(array(
            array('id' => 1, 'type' => 'discrete'),
            array('id' => 2, 'type' => 'accumulative')
        ));
    }

}