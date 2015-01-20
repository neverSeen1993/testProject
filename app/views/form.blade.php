@include('header')

{{HTML::script('/assets/js/formDatePicker.js')}}

{{--{{ HTML::ul($errors->all(), array('class' => 'errorList')) }}--}}
<ul class="errorList"></ul>
<div class="col-xs-5">
{{ Form::open(array('url' => 'form')) }}

    <div class="form-group">
        {{ Form::label('group_id', 'Группа ') }}
        {{ Form::select('group_id', $groups, null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('esvPeriod', 'Период оплаты ЕСВ') }}
        {{ Form::select('esvPeriod', array('1'=>'Ежемесячно','2'=>'Ежеквартально'), null, array('class' => 'form-control')) }}
    </div>

    <div class="row">
        <div class="form-group col-xs-6">
            {{ Form::label('dateStart', 'Дата начала') }}
            {{ Form::text('dateStart', null, array('class' => 'form-control datepicker'))  }}
        </div>

        <div class="form-group col-xs-6">
            {{ Form::label('dateFinish', 'Дата окончания') }}
            {{ Form::text('dateFinish', null, array('class' => 'form-control datepicker'))  }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('language', 'Язык') }}
        {{ Form::select('language', array('1'=>'Русский','2'=>'Українська'), null, array('class' => 'form-control')) }}
    </div>

     {{ Form::submit('Отправить', array('class' => 'btn', 'id' => 'submitButton')) }}

{{ Form::close() }}
</div>
<div class="col-xs-6 pull-right">
    <div class="tasks">
        <h3>Налоговая декларация / Податкова декларацiя</h3>
        <ul class="task1"></ul>
        <h3>Единый налог / Єдиний податок</h3>
        <ul class="task2"></ul>
        <h3>Единый социальный взнос / Єдиний соцiальний внесок</h3>
        <ul class="task3"></ul>
    </div>
</div>
@include('footer')
