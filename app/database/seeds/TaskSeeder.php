<?php

class TaskSeeder extends Seeder
{

    public function run()
    {
        DB::table('tasks')->delete();

        DB::table('tasks')->insert(array(
            array('id' => 1, 'name' => 'declaration', 'text' => 'Сдать налоговую декларацию за ', 'textUa' => 'Здати податкову декларацію за '),
            array('id' => 2, 'name' => 'esv', 'text' => 'Оплатить ЕСВ за ', 'textUa' => 'Сплатити ЄСВ за '),
            array('id' => 3, 'name' => 'en', 'text' => 'Оплатить ЕН за ', 'textUa' => 'Сплатити ЄН за ')
        ));
    }

}