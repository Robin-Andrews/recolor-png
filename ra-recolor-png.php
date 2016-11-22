<?

$path = __dir__ . '/images/';
$image_file = $path . 'etsy.png';

$img = imagecreatefromstring(file_get_contents($image_file));
$width = imagesx($img);
$hieght = imagesy($img);

$atomic = imagecolorallocate($img, 70, 73, 74);

for ($x = 0; $x < $width; $x++) {
    for ($y = 0; $y < $width; $y++) {
        $color = imagecolorat($img, $x, $y);
        $color = imagecolorsforindex($img, $color);
        if ($color['alpha'] !== 127) {
           imagesetpixel($img, $x, $y, $atomic);
        }
    }
}

$save = $path . 'atomic-logo.png';
imagepng($img, $save);
imagedestroy($img);

?>

