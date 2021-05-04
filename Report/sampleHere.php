<?php
function weekOfMonth($qDate) {
    $dt = strtotime($qDate);
    $day  = date('j',$dt);
    $month = date('m',$dt);
    $year = date('Y',$dt);
    $totalDays = date('t',$dt);
    $weekCnt = 1;
    $retWeek = 0;
    for($i=1;$i<=$totalDays;$i++) {
        $curDay = date("N", mktime(0,0,0,$month,$i,$year));
        if($curDay==7) {
            if($i==$day) {
                $retWeek = $weekCnt+1;
            }
            $weekCnt++;
        } else {
            if($i==$day) {
                $retWeek = $weekCnt;
            }
        }
    }
    return $retWeek;
}


$date = "2019-04-30";

echo weekOfMonth($date);