<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class GroupTask extends Eloquent implements UserInterface, RemindableInterface
{

    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'groupTasks';

    public function tasks(){
        return $this->hasMany('Task', 'task_id');
    }

    public function groups(){
        return $this->hasMany('Group', 'group_id');
    }

    public function periodicity(){
        return $this->hasMany('Periodicity', 'periodicity_id');
    }

    public function timeIndex(){
        return $this->hasMany('TimeIndex', 'timeIndex');
    }

    public function accumulation(){
        return $this->hasMany('Accumulation', 'accumulation');
    }
}
