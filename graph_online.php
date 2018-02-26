<?php
//создаем рисунок шириной 500 и высотой 400 пикселов
$im = @ImageCreate(500, 400);
$white = ImageColorAllocate ($im, 255, 255, 255);
$black = ImageColorAllocate ($im, 0, 0, 0);
$red = ImageColorAllocate ($im, 255, 0, 0);
$green = ImageColorAllocate ($im, 0, 255, 0);
$blue = ImageColorAllocate ($im, 0, 0, 255);
$yellow = ImageColorAllocate ($im, 255, 255, 0);
$magenta = ImageColorAllocate ($im, 255, 0, 255);
$cyan = ImageColorAllocate ($im, 0, 255, 255);
$l_grey = ImageColorAllocate ($im, 221, 221, 221);
//рисуем оси координат
draw_axises(500,400);
//задаем массивы данных графиков
$x1[0]=1; $y1[0]=1;
$x1[1]=2; $y1[1]=4;
$x1[2]=3; $y1[2]=8;
$x1[3]=4; $y1[3]=16;
$x2[0]=1.5; $y2[0]=1;
$x2[1]=2.5; $y2[1]=4;
$x2[2]=3.5; $y2[2]=8;
$x2[3]=4.5; $y2[3]=16;
//объединяем данные из массивов данных
//для вычисления масштаба
$x=array_merge($x1,$x2);
$y=array_merge($y1,$y2);
//получаем максимальные значения
//элементов для каждого массива
$maxXVal=max($x);
$maxYVal=max($y);
//вычисляем масштаб преобразования данных
//в координаты рабочей области
$scaleX=($maxX-$x0)/$maxXVal;
$scaleY=($maxY-$y0)/$maxYVal;
//задаем шаг для координатной сетки в пикселах
$xStep=30;
$yStep=30;
//рисуем координатную сетку
draw_grid($xStep,$yStep,
    round($xStep/$scaleX,1),
    round($yStep/$scaleY,1),
    true);
//рисуем первый график
draw_data($x1,$y1,4,$red);
//рисуем второй график
draw_data($x2,$y2,4,$blue);
//выводим рисунок
Header("Content-Type: image/png");
ImagePNG($im);
//освобождаем занимаемую рисунком память
imagedestroy($im);
?>