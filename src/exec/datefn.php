<?php
// обработка даты

function zmdate($date){
//$datee = $date - 284012334;
$datee = $date;
$daydate = date("z",$datee);
$yeardate = date("Y",$datee);
$yeartoday = date("Y",time());
$daytommorow = date("z",time()-86400);
$daynow = date("z",time());
$chyear = date("L",time());
if(time() <= $datee+15){
$text = "только что";
}elseif(time() <= $datee+120){
$text = "минуту назад";
}elseif(time() <= $datee+180){
$text = "2 минуты назад";
}elseif(time() <= $datee+240){
$text = "3 минуты назад";
}elseif(time() <= $datee+300){
$text = "4 минуты назад";
}elseif(time() <= $datee+360){
$text = "5 минут назад";
}elseif(time() <= $datee+420){
$text = "6 минут назад";
}elseif(time() <= $datee+480){
$text = "7 минут назад";
}elseif(time() <= $datee+540){
$text = "8 минут назад";
}elseif(time() <= $datee+600){
$text = "9 минут назад";
}elseif(time() <= $datee+660){
$text = "10 минут назад";
}elseif(time() <= $datee+720){
$text = "11 минут назад";
}elseif(time() <= $datee+780){
$text = "12 минут назад";
}elseif(time() <= $datee+840){
$text = "13 минут назад";
}elseif(time() <= $datee+900){
$text = "14 минут назад";
}elseif(time() <= $datee+960){
$text = "15 минут назад";
}elseif(time() <= $datee+1020){
$text = "16 минут назад";
}elseif(time() <= $datee+1080){
$text = "17 минут назад";
}elseif(time() <= $datee+1140){
$text = "18 минут назад";
}elseif(time() <= $datee+1200){
$text = "19 минут назад";
}elseif(time() <= $datee+1260){
$text = "20 минут назад";
}elseif(time() <= $datee+1320){
$text = "21 минут назад";
}elseif(time() <= $datee+1380){
$text = "22 минуты назад";
}elseif(time() <= $datee+1440){
$text = "23 минуты назад";
}elseif(time() <= $datee+1500){
$text = "24 минуты назад";
}elseif(time() <= $datee+1560){
$text = "25 минут назад";
}elseif(time() <= $datee+1620){
$text = "26 минут назад";
}elseif(time() <= $datee+1680){
$text = "27 минут назад";
}elseif(time() <= $datee+1740){
$text = "28 минут назад";
}elseif(time() <= $datee+1800){
$text = "29 минут назад";
}elseif(time() <= $datee+1860){
$text = "30 минут назад";
}elseif($daynow == $daydate AND $yeardate == $yeartoday){
$text = "сегодня в ".date("H:i",$datee);
}elseif ($daytommorow == $daydate AND $yeardate == $yeartoday) {
$text = "вчера в ".date("H:i",$datee);
}else{
$text = date("d F Y ",$datee).'в'.date(" H:i",$datee);
$text = str_replace("January","января",$text);
$text = str_replace("February","февраля",$text);
$text = str_replace("March","марта",$text);
$text = str_replace("April","апреля",$text);
$text = str_replace("May","мая",$text);
$text = str_replace("June","июня",$text);
$text = str_replace("July","июля",$text);
$text = str_replace("August","августа",$text);
$text = str_replace("September","сентября",$text);
$text = str_replace("October","октября",$text);
$text = str_replace("November","ноября",$text);
$text = str_replace("December","декабря",$text);
}
return $text; // 22 сентября 2017 в 04:20
}

function zmbd($date){ // дата рождения. может пригодиться для других целей
//$datee = $date - 284012334;
$datee = $date;
$daydate = date("z",$datee);
$yeardate = date("Y",$datee);
$yeartoday = date("Y",time());
$daynow = date("z",time());
$chyear = date("L",time());
if(time() <= $datee+15){
$text = "только что";
}elseif(time() <= $datee+120){
$text = "минуту назад";
}elseif(time() <= $datee+180){
$text = "2 минуты назад";
}elseif(time() <= $datee+240){
$text = "3 минуты назад";
}elseif(time() <= $datee+300){
$text = "4 минуты назад";
}elseif(time() <= $datee+360){
$text = "5 минут назад";
}elseif(time() <= $datee+420){ // разбуди меня в 4:20 ))
$text = "6 минут назад";
}elseif(time() <= $datee+480){
$text = "7 минут назад";
}elseif(time() <= $datee+540){
$text = "8 минут назад";
}elseif(time() <= $datee+600){
$text = "9 минут назад";
}elseif(time() <= $datee+660){
$text = "10 минут назад";
}elseif(time() <= $datee+720){
$text = "11 минут назад";
}elseif(time() <= $datee+780){
$text = "12 минут назад";
}elseif(time() <= $datee+840){
$text = "13 минут назад";
}elseif(time() <= $datee+900){
$text = "14 минут назад";
}elseif(time() <= $datee+960){
$text = "15 минут назад";
}elseif(time() <= $datee+1020){
$text = "16 минут назад";
}elseif(time() <= $datee+1080){
$text = "17 минут назад";
}elseif(time() <= $datee+1140){
$text = "18 минут назад";
}elseif(time() <= $datee+1200){
$text = "19 минут назад";
}elseif(time() <= $datee+1260){
$text = "20 минут назад";
}elseif(time() <= $datee+1320){
$text = "21 минуту назад";
}elseif(time() <= $datee+1380){
$text = "22 минуты назад";
}elseif(time() <= $datee+1440){
$text = "23 минуты назад";
}elseif(time() <= $datee+1500){
$text = "24 минуты назад";
}elseif(time() <= $datee+1560){
$text = "25 минут назад";
}elseif(time() <= $datee+1620){
$text = "26 минут назад";
}elseif(time() <= $datee+1680){
$text = "27 минут назад";
}elseif(time() <= $datee+1740){
$text = "28 минут назад";
}elseif(time() <= $datee+1800){
$text = "29 минут назад";
}elseif(time() <= $datee+1860){
$text = "30 минут назад";
}elseif($daynow == $daydate AND $yeardate == $yeartoday){
$text = "сегодня в ".date("H:i",$datee);
}else{
$text = date("d F Y",$datee);
$text = str_replace("January","января",$text);
$text = str_replace("February","февраля",$text);
$text = str_replace("March","марта",$text);
$text = str_replace("April","апреля",$text);
$text = str_replace("May","мая",$text);
$text = str_replace("June","июня",$text);
$text = str_replace("July","июля",$text);
$text = str_replace("August","августа",$text);
$text = str_replace("September","сентября",$text);
$text = str_replace("October","октября",$text);
$text = str_replace("November","ноября",$text);
$text = str_replace("December","декабря",$text);
}
return $text; // 19 ноября 2002
}

function zmdateapi($date){ // дата для api
//$datee = $date - 284012334;
$datee = $date;
$text = date("d.n.Y",$datee);
return $text; // 8.10.2017
}

function zmd($date){ // дата , для блядской тусовки (сделал вова)
//$datee = $date - 284012334;
$datee = $date;
$daydate = date("z",$datee);
$daynow = date("z",time());
$chyear = date("L",time());
$daytommorow = date("z",time()-86400);
$dayyesterday = date("z",time()+86400);
if($daynow == $daydate){
$text = "сегодня в ".date("H:i",$datee);
}elseif ($daytommorow == $daydate) {
$text = "вчера в ".date("H:i",$datee);
}elseif ($dayyesterday == $daydate) {
$text = "завтра в ".date("H:i",$datee);
}else{
$text = date("d F Y ",$datee).'в'.date(" H:i",$datee);
$text = str_replace("January","января",$text);
$text = str_replace("February","февраля",$text);
$text = str_replace("March","марта",$text);
$text = str_replace("April","апреля",$text);
$text = str_replace("May","мая",$text);
$text = str_replace("June","июня",$text);
$text = str_replace("July","июля",$text);
$text = str_replace("August","августа",$text);
$text = str_replace("September","сентября",$text);
$text = str_replace("October","октября",$text);
$text = str_replace("November","ноября",$text);
$text = str_replace("December","декабря",$text);

}
return $text;
}
?>