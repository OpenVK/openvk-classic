<?php
// файл
$filename = $_GET['image'];
 
// задание максимальной ширины и высоты
$width = 200;
$height = 800;
 
 
// получение новых размеров
list($width_orig, $height_orig) = getimagesize($filename);
 
$ratio_orig = $width_orig/$height_orig;
 
if ($width/$height > $ratio_orig) {
   $width = $height*$ratio_orig;
} else {
   $height = $width/$ratio_orig;
}
 
// ресэмплирование
$image_p = imagecreatetruecolor($width, $height);
$image = imagecreatefromjpeg($filename);
imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
 header("Content-type: image/jpeg");
// вывод
imagejpeg($image_p, null, 100);
?>