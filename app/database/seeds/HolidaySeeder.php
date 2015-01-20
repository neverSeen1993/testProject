<?php

class HolidaySeeder extends Seeder
{

    public function run()
    {
        DB::table('holidays')->delete();

        DB::table('holidays')->insert(array(
            array('id' => 1, 'name' => 'Новый Год', 'day' => '01', 'month' => '01'),
            array('id' => 2, 'name' => 'Рождество', 'day' => '07', 'month' => '01'),
            array('id' => 3, 'name' => 'День Независимости', 'day' => '24', 'month' => '08'),
            array('id' => 4, 'name' => 'Международный женский день', 'day' => '08', 'month' => '03'),
            array('id' => 5, 'name' => 'Пасха', 'day' => '12', 'month' => '04'),
            array('id' => 6, 'name' => '1 мая', 'day' => '01', 'month' => '05'),
            array('id' => 7, 'name' => '2 мая', 'day' => '02', 'month' => '05'),
            array('id' => 8, 'name' => 'День победы', 'day' => '09', 'month' => '05'),
            array('id' => 9, 'name' => 'Троица', 'day' => '31', 'month' => '05'),
            array('id' => 10, 'name' => 'День Конституции', 'day' => '28', 'month' => '06'),
        ));
    }

}