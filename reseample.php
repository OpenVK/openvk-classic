<?
function reseample($filename, $final, $width, $height)
{
	// получение новых размеров
	list($width_orig, $height_orig) = getimagesize($filename);
			 
	$ratio_orig = $width_orig/$height_orig;
					
	if ($width <= $width_orig && $height <= $height_orig) {
		if ($width/$height > $ratio_orig) {
			$width = $height*$ratio_orig;
		} else {
			$height = $width/$ratio_orig;
		}
	}else{
		$width = $width_orig;
		$height = $height_orig;
	}
							
	// ресэмплирование
	$image_p = imagecreatetruecolor($width, $height);
	$image = imagecreatefromjpeg($filename);
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
	imagejpeg($image_p, $final, 90);
}
					
?>