<?php

class PeriodicitySeeder extends Seeder
{

    public function run()
    {
        DB::table('periodicity')->delete();

        DB::table('periodicity')->insert(array(
            array('id' => 1, 'period' => 'year', 'text' => 'год', 'textUa' => 'рік'),
            array('id' => 2, 'period' => 'quarter', 'text' => 'квартал', 'textUa' => 'квартал'),
            array('id' => 3, 'period' => 'month', 'text' => 'месяц', 'textUa' => 'місяць')
        ));
    }

}