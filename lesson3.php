<?php
$timestamp = time();
$dates = array(
    rand(0,$timestamp),
    rand(0,$timestamp),
    rand(0,$timestamp),
    rand(0,$timestamp),
    rand(0,$timestamp),
);
$textdates = array (
    date("l d.m.y",$dates[0]),
    date("l d.m.y",$dates[1]),
    date("l d.m.y",$dates[2]),
    date("l d.m.y",$dates[3]),
    date("l d.m.y",$dates[4]),
);
$days = array (
  (int)date("j",$dates[0]),  
  (int)date("j",$dates[1]),  
  (int)date("j",$dates[2]),  
  (int)date("j",$dates[3]),  
  (int)date("j",$dates[4])  
);
$months = array (
    (int)date("m",$dates[0]),
    (int)date("m",$dates[1]),
    (int)date("m",$dates[2]),
    (int)date("m",$dates[3]),
    (int)date("m",$dates[4])
);
$minday = min($days);
$maxmonth = max($months);
var_dump($textdates);
echo '<br>Ok, let me see, the min day is: "'.$minday.'", and the max month: "'.$maxmonth.'"';

array_multisort($dates,SORT_ASC);
//var_dump($textdates);
$selected = date("d.m.y h:i:s",array_pop($dates));
echo '<br>'.date_default_timezone_get();
echo '<br>Selected date is: '.$selected;
date_default_timezone_set('America/New_York');
echo '<br>'.date_default_timezone_get();
?>