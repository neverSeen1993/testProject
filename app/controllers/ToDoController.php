<?php

class ToDoController extends BaseController
{
    public $data;

    public function getJSON()
    {
        $json = json_decode($_POST['formData']);
        foreach ($json as $key => $value) {
            $data[$key] = $value;
        }
        $data['group_id'] += 1;
        if ($data['dateFinish'] == '') {
            $dateFinish = date('d/m/Y');
        }
        $dateFinish = $data['dateFinish'];
        $rules = [
            'group_id' => 'required',
            'esvPeriod' => 'required',
            'dateStart' => 'required | date_format:"d/m/yy"| before:' . $dateFinish,
            'dateFinish' => 'required | date_format:"d/m/yy"',
            'language' => 'required',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ), 200);
        } else {
            $result = $this->getTasks($data);
            return Response::json(array(
                'success' => true,
                'result' => $result,
            ), 200);
        }
    }

    public function getTasks($clientData)
    {
        $dbCurrentData = GroupTask::where('group_id', '=', $clientData['group_id'])->where('task_id', '=', 1)->get();
        $periodicity = $dbCurrentData[0]['periodicity_id'];
        $accumulation = $dbCurrentData[0]['accumulation'];
        $timeIndex = $dbCurrentData[0]['timeIndex'];

        $year = (int)($clientData['dateStart'][6] . $clientData['dateStart'][7] . $clientData['dateStart'][8] . $clientData['dateStart'][9]);
        $monthStart = (int)($clientData['dateStart'][3] . $clientData['dateStart'][4]);
        $monthFinish = (int)($clientData['dateFinish'][3] . $clientData['dateFinish'][4]);
        $monthArray = array(
            1 => array('nameRus' => 'Январь', 'nameUa' => 'Січень', 'length' => 31),
            2 => array('nameRus' => 'Февраль', 'nameUa' => 'Лютий', 'length' => 28),
            3 => array('nameRus' => 'Март', 'nameUa' => 'Березень', 'length' => 31),
            4 => array('nameRus' => 'Апрель', 'nameUa' => 'Квітень', 'length' => 30),
            5 => array('nameRus' => 'Май', 'nameUa' => 'Травень', 'length' => 31),
            6 => array('nameRus' => 'Июнь', 'nameUa' => 'Червень', 'length' => 30),
            7 => array('nameRus' => 'Июль', 'nameUa' => 'Липень', 'length' => 31),
            8 => array('nameRus' => 'Август', 'nameUa' => 'Серпень', 'length' => 31),
            9 => array('nameRus' => 'Сентябрь', 'nameUa' => 'Вересень', 'length' => 30),
            10 => array('nameRus' => 'Октябрь', 'nameUa' => 'Жовтень', 'length' => 31),
            11 => array('nameRus' => 'Ноябрь', 'nameUa' => 'Листопад', 'length' => 30),
            12 => array('nameRus' => 'Декабрь', 'nameUa' => 'Грудень', 'length' => 31)
        );
        if ($year % 4 == 0) {
            $monthArray[2]['length'] = 29;
        }
        $quarterStart = (int)(($monthStart - 1) / 3) + 1;
        $quarterFinish = (int)(($monthFinish - 1) / 3) + 1;

        $string = Task::where('id', '=', 1)->get();

        if ($clientData['language'] == 1) {
            $resultStart = $string[0]['text'];
        } else {
            $resultStart = $string[0]['textUa'];
        }


        $resultTime2 = '';
        switch ($periodicity) {
            case 1:
                switch ($timeIndex) {
                    case 1:
                        $resultTime1 = $year - 1;
                        $deadlineStartDay = 1;
                        $deadlineStartMonth = 1;
                        $deadlineFinishDay = $deadlineStartDay + $dbCurrentData[0]['deadline'];
                        $deadlineFinishDay -= $monthArray[$deadlineStartMonth]['length'];
                        $deadlineFinishMonth = 2;
                        $newDate = $this->skipWeekend($deadlineFinishDay, $deadlineFinishMonth, $year, 'next');
                        $deadlineFinishDay = $newDate['day'];
                        $deadlineFinishMonth = $newDate['month'];
                        break;
                    case 2:
                        $resultTime1 = $year;
                        $deadlineStartDay = 1;
                        $deadlineStartMonth = 1;
                        $deadlineFinishDay = $deadlineStartDay + 1 + $dbCurrentData[0]['deadline'];
                        $deadlineFinishMonth = 2;
                        $newDate = $this->skipWeekend($deadlineFinishDay, $deadlineFinishMonth, $year, 'next');
                        $deadlineFinishDay = $newDate['day'];
                        $deadlineFinishMonth = $newDate['month'];
                        break;
                }
                break;
            case 2:
                switch ($timeIndex) {
                    case 1:
                        $resultTime1 = $quarterFinish - 1;
                        $resultTime2 = $year;
                        $deadlineStartMonth = $resultTime1 * 3 + 1;
                        if ($resultTime1 == 0) {
                            $resultTime1 = 4;
                            $resultTime2 = $year - 1;
                        }
                        $deadlineStartDay = 1;
                        $deadlineFinishDay = $deadlineStartDay + $dbCurrentData[0]['deadline'];
                        $deadlineFinishDay -= $monthArray[$deadlineStartMonth]['length'];
                        $deadlineFinishMonth = $deadlineStartMonth + 1;
                        $newDate = $this->skipWeekend($deadlineFinishDay, $deadlineFinishMonth, $year, 'next');
                        $deadlineFinishDay = $newDate['day'];
                        $deadlineFinishMonth = $newDate['month'];
                        break;
                    case 2:
                        $resultTime1 = $quarterFinish;
                        break;
                }
                break;
            case 3:
                switch ($timeIndex) {
                    case 1:
                        $resultTime1 = $monthFinish - 1;
                        $resultTime2 = $year;
                        if ($resultTime1 == 0) {
                            $resultTime1 = 12;
                            $resultTime2 = $year - 1;
                        }
                        break;
                    case 2:
                        $resultTime1 = $monthFinish;
                        break;
                }
                break;
        }

        $string = Periodicity::where('id', '=', $periodicity)->get();
        $resultPeriod = ' ' . $string[0]['text'];
        if ($accumulation == 2) {
            if ($resultTime1 != 1) {
                $resultPeriod .= 'a';
            }
        }
        if ($clientData['language'] == 1) {
            $declarationResult = $resultStart . $resultTime1 . $resultPeriod . ' ' . $resultTime2 . ' - c ' . $deadlineStartDay . ' ' . $monthArray[$deadlineStartMonth]["nameRus"] . ' по ' . $deadlineFinishDay . ' ' . $monthArray[$deadlineFinishMonth]["nameRus"];
        } else {
            $declarationResult = $resultStart . $resultTime1 . $resultPeriod . ' ' . $resultTime2 . ' - з ' . $deadlineStartDay . ' ' . $monthArray[$deadlineStartMonth]["nameUa"] . ' по ' . $deadlineFinishDay . ' ' . $monthArray[$deadlineFinishMonth]["nameUa"];
        }

        $dbCurrentData = GroupTask::where('group_id', '=', $clientData['group_id'])->where('task_id', '=', 2)->get();
        $string = Task::where('id', '=', 2)->get();
        $esvStrategy = $clientData['esvPeriod'];
        $resultStart = [];
        $resultTime1 = [];
        $resultTime2 = [];
        if (($clientData['group_id'] == 4) || ($clientData['group_id'] == 6)) {
            if ($clientData['language'] == 1) {
                $resultEsv = array('Актуальных задач по оплате ЕСВ нет');
            } else {
                $resultEsv = array('Актуальних задач по оплаті ЄСВ немає');
            }
        } else {
            switch ($esvStrategy) {
                case 1:
                    for ($i = $monthStart; $i <= $monthFinish; $i++) {
                        $k = $i - 1;
                        if ($k == 0) {
                            $k = 12;
                        }
                        if ($clientData['language'] == 1) {
                            $resultStart[$i] = $string[0]['text'];
                            $resultTime1[$i] = $monthArray[$k]['nameRus'];
                            $resultTime2[$i] = $year;
                            $newDate = $this->skipWeekend($dbCurrentData[0]['deadline'], $i, $year, 'prev');
                            $day = $newDate['day'];
                            $month = $newDate['month'];
                            $resultDeadline[$i] = ' до ' . $day . ' ' . $monthArray[$month]['nameRus'] . ' ' . $year;
                            if ($k == 12) {
                                $resultTime2[$i] = $year - 1;
                            }
                        } else {
                            $resultStart[$i] = $string[0]['textUa'];
                            $resultTime1[$i] = $monthArray[$k]['nameUa'];
                            $newDate = $this->skipWeekend($dbCurrentData[0]['deadline'], $i, $year, 'prev');
                            $day = $newDate['day'];
                            $month = $newDate['month'];
                            $resultDeadline[$i] = ' до ' . $day . ' ' . $monthArray[$month]['nameUa'] . ' ' . $year;
                            if ($k == 12) {
                                $resultTime2[$i] = $year - 1;
                            }
                            $resultTime2[$i] = $year;
                        }
                        $resultEsv[$i] = $resultStart[$i] . $resultTime1[$i] . ' ' . $resultTime2[$i] . $resultDeadline[$i];
                    }
                    break;
                case 2:
                    for ($i = $monthStart; $i <= $monthFinish; $i++) {
                        if (($i == 4) || ($i == 7) || ($i == 10) || ($i == 1)) {
                            if ($clientData['language'] == 1) {
                                $resultStart[$i] = $string[0]['text'];
                                $resultTime1[$i] = (int)(($i - 1) / 3);
                                $resultTime2[$i] = $year;
                                if ($resultTime1[$i] == 0) {
                                    $resultTime1[$i] = 4;
                                    $resultTime2[$i] = $year - 1;
                                }
                                $resultTime1[$i] .= ' квартал ';
                                $newDate = $this->skipWeekend($dbCurrentData[0]['deadline'], $i, $year, 'prev');
                                $day = $newDate['day'];
                                $month = $newDate['month'];
                                $resultDeadline[$i] = ' до ' . $day . ' ' . $monthArray[$month]['nameRus'] . ' ' . $year;
                                $resultEsv[$i] = $resultStart[$i] . $resultTime1[$i] . $resultTime2[$i] . $resultDeadline[$i];
                            } else {
                                $resultStart[$i] = $string[0]['textUa'];
                                $resultTime1[$i] = (int)(($i - 1) / 3);
                                $resultTime2[$i] = $year;
                                if ($resultTime1[$i] == 0) {
                                    $resultTime1[$i] = 4;
                                    $resultTime2[$i] = $year - 1;
                                }
                                $resultTime1[$i] .= ' квартал ';
                                $newDate = $this->skipWeekend($dbCurrentData[0]['deadline'], $i, $year, 'prev');
                                $day = $newDate['day'];
                                $month = $newDate['month'];
                                $resultDeadline[$i] = ' до ' . $day . ' ' . $monthArray[$month]['nameUa'] . ' ' . $year;
                                $resultEsv[$i] = $resultStart[$i] . $resultTime1[$i] . $resultTime2[$i] . $resultDeadline[$i];
                            }
                        }
                    }
                    break;
            }
        }


        $dbCurrentData = GroupTask::where('group_id', '=', $clientData['group_id'])->where('task_id', '=', 3)->get();
        $string = Task::where('id', '=', 3)->get();
        $periodicity = $dbCurrentData[0]['periodicity_id'];
        $accumulation = $dbCurrentData[0]['accumulation'];
        $timeIndex = $dbCurrentData[0]['timeIndex'];
        $enStrategy = $clientData['esvPeriod'];
        $resultStart = [];
        $resultTime1 = [];
        $resultTime2 = [];

        switch ($periodicity) {
            case 2:
                for ($i = $monthStart; $i <= $monthFinish; $i++) {
                    if (($i == 4) || ($i == 7) || ($i == 10) || ($i == 1)) {
                        if ($clientData['language'] == 1) {
                            $resultStart[$i] = $string[0]['text'];
                            $resultTime1[$i] = (int)(($i - 1) / 3);
                            $resultTime2[$i] = $year;
                            if ($resultTime1[$i] == 0) {
                                $resultTime1[$i] = 4;
                                $resultTime2[$i] = $year - 1;
                            }
                            $resultTime1[$i] .= ' квартал ';
                            $newDate = $this->skipWeekend($dbCurrentData[0]['deadline'] - $monthArray[$i]['length'], $i,
                                $year, 'prev');
                            $day = $newDate['day'];
                            $month = $newDate['month'];
                            $resultDeadline[$i] = ' до ' . $day . ' ' . $monthArray[$month + 1]['nameRus'] . ' ' . $year;
                            $resultEn[$i] = $resultStart[$i] . $resultTime1[$i] . $resultTime2[$i] . $resultDeadline[$i];
                        } else {
                            $resultStart[$i] = $string[0]['textUa'];
                            $resultTime1[$i] = (int)(($i - 1) / 3);
                            $resultTime2[$i] = $year;
                            if ($resultTime1[$i] == 0) {
                                $resultTime1[$i] = 4;
                                $resultTime2[$i] = $year - 1;
                            }
                            $resultTime1[$i] .= ' квартал ';
                            $newDate = $this->skipWeekend($dbCurrentData[0]['deadline'] - $monthArray[$i]['length'], $i,
                                $year, 'prev');
                            $day = $newDate['day'];
                            $month = $newDate['month'];
                            $resultDeadline[$i] = ' до ' . $day . ' ' . $monthArray[$month + 1]['nameUa'] . ' ' . $year;
                            $resultEn[$i] = $resultStart[$i] . $resultTime1[$i] . $resultTime2[$i] . $resultDeadline[$i];
                        }
                    }
                }
                break;
            case 3:
                for ($i = $monthStart; $i <= $monthFinish; $i++) {
                    if ($clientData['language'] == 1) {
                        $resultStart[$i] = $string[0]['text'];
                        $resultTime1[$i] = $monthArray[$i]['nameRus'];
                        $resultTime2[$i] = $year;
                        $newDate = $this->skipWeekend($dbCurrentData[0]['deadline'], $i, $year, 'prev');
                        $day = $newDate['day'];
                        $month = $newDate['month'];
                        $resultDeadline[$i] = ' до ' . $day . ' ' . $monthArray[$month]['nameRus'] . ' ' . $year;
                    } else {
                        $resultStart[$i] = $string[0]['textUa'];
                        $resultTime1[$i] = $monthArray[$i]['nameUa'];
                        $newDate = $this->skipWeekend($dbCurrentData[0]['deadline'], $i, $year, 'prev');
                        $day = $newDate['day'];
                        $month = $newDate['month'];
                        $resultDeadline[$i] = ' до ' . $day . ' ' . $monthArray[$month]['nameUa'] . ' ' . $year;
                        $resultTime2[$i] = $year;
                    }
                    $resultEn[$i] = $resultStart[$i] . $resultTime1[$i] . ' ' . $resultTime2[$i] . $resultDeadline[$i];
                }
                break;
        }

        $result = array($declarationResult, $resultEn, $resultEsv);
        return ($result);

    }

    public function skipWeekend($day, $month, $year, $indicator)
    {
        $d = sprintf('%02s', $day);
        $m = sprintf('%02s', $month);
        $y = $year;
        $date = $d . '-' . $m . '-' . $y;
        $saturday = date('d-m-Y', strtotime($date . 'Saturday'));
        $sunday = date('d-m-Y', strtotime($date . 'Sunday'));
        $todayIsHoliday = (sizeof(Holiday::where('day', '=', $d)->where('month', '=', $m)->get()) > 0);
        if ($indicator == 'next') {
            do {
                $key = false;
                if (($date == $saturday) || ($date == $sunday) || ($todayIsHoliday)) {
                    $newDate = date('d-m-Y', strtotime($date . ' + 1 days'));
                    $key = true;
                    $date = $newDate;
                    $d = (int)($date[0] . $date[1]);
                    $m = (int)($date[3] . $date[4]);
                    $todayIsHoliday = (sizeof(Holiday::where('day', '=', $d)->where('month', '=', $m)->get()) > 0);
                }
            } while ($key);
        } else {
            do {
                $key = false;
                if (($date == $saturday) || ($date == $sunday) || ($todayIsHoliday)) {
                    $newDate = date('d-m-Y', strtotime($date . ' - 1 days'));
                    $key = true;
                    $date = $newDate;
                    $d = (int)($date[0] . $date[1]);
                    $m = (int)($date[3] . $date[4]);
                    $todayIsHoliday = (sizeof(Holiday::where('day', '=', $d)->where('month', '=', $m)->get()) > 0);
                }
            } while ($key);
        }
        $day = (int)($date[0] . $date[1]);
        $month = (int)($date[3] . $date[4]);
        $year = (int)($date[6] . $date[7] . $date[8] . $date[9]);
        $newDate = array('day' => $day, 'month' => $month, 'year' => $year);
        return $newDate;
    }

}