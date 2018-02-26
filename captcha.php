<?php
/* 
	Appointment: АнтиБОТ
	File: antibot.php 
 
*/
session_start();
	
$width = 120;				//Ширина изображения
$height = 50;				//Высота изображения
$font_size = 16;   			//Размер шрифта
$let_amount = 5;			//Количество символов, которые нужно набрать
$fon_let_amount = 30;		//Количество символов на фоне
$font = "files/cour.ttf";	//Путь к шрифту
 
//набор символов
$letters = array('к', 'и', 'л', 'а', 'м', 'о', 'л', 'о', 'д', 'о', 'й', '1', '3', '5', '7', '9');		

//Цвета для фона
$background_color = array(mt_rand(200, 255), mt_rand(200, 255), mt_rand(200, 255));

//Цвета для обводки
$foreground_color = array(mt_rand(0, 100), mt_rand(0, 100), mt_rand(0, 100));

$src = imagecreatetruecolor($width,$height); //создаем изображение			
	
$fon = imagecolorallocate($src, $background_color[0], $background_color[1], $background_color[2]); //создаем фон

imagefill($src,0,0,$fon); //заливаем изображение фоном

//то же самое для основных букв
for($i=0; $i < $let_amount; $i++){
	$color = imagecolorallocatealpha($src, $foreground_color[0], $foreground_color[1], $foreground_color[2], rand(20,40)); //Цвет шрифта
	$letter = $letters[rand(0,sizeof($letters)-1)];
	$size = rand($font_size*2-2,$font_size*2+2);
	$x = ($i+1)*$font_size + rand(2,5); //даем каждому символу случайное смещение
	$y = (($height*2)/3) + rand(0,5);							
	$cod[] = $letter; //запоминаем код
	imagettftext($src,$size,rand(0,15),$x,$y,$color,$font,$letter);
}

$foreground = imagecolorallocate($src, $foreground_color[0], $foreground_color[1], $foreground_color[2]);

imageline($src, 0, 0,  $width, 0, $foreground);
imageline($src, 0, 0,  0, $height, $foreground);
imageline($src, 0, $height-1,  $width, $height-1, $foreground);
imageline($src, $width-1, 0,  $width-1, $height, $foreground);

$cod = implode("",$cod); //переводим код в строку
 
header("Content-type: image/gif"); //выводим готовую картинку

imagegif($src); 

$_SESSION['sec_code'] = $cod; //Добавляем код в сессию
?>