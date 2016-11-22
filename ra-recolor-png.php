<?php
/**
 * It's generally a good idea to add a description of your code
 *
 * @author Robin Andrews (prandrews@hotmail.co.uk)
 * @license MIT
 */

$path = __dir__ . '/images/';
$image_file = $path . 'etsy.png';

$img = imagecreatefromstring(file_get_contents($image_file));
$width = imagesx($img);
$height = imagesy($img);

$atomic = imagecolorallocate($img, 70, 73, 74);

for ($x = 0; $x < $width; $x++) {
    for ($y = 0; $y < $height; $y++) {
        $color = imagecolorat($img, $x, $y);
        $color = imagecolorsforindex($img, $color);
        if ($color['alpha'] !== 127) {
           imagesetpixel($img, $x, $y, $atomic);
        }
    }
}

$newFile = $path . 'atomic-logo.png';
imagepng($img, $newFile);
imagedestroy($img);