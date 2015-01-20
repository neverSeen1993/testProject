<?php

class FormController extends BaseController
{

    public function create()
    {
        $data = Group::all();
        foreach ($data as $key=>$value) {
            $groups[] = $data[$key]['id'];
        }
        return View::make('form')->with('groups',$groups);
    }

}