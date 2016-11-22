<?php
/**
 * Class to recolour a transparent image preserving transparency
 *
 * @author Robin Andrews (prandrews@hotmail.co.uk)
 * @author David Yell (neon1024@gmail.com)
 * @license MIT
 */
namespace robinandrews\recolor;

class Recolor {

    /**
     * Where the image stored
     *
     * @var string
     */
    private $imageFolder = __DIR__ . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;

    /**
     * Process an image file
     *
     * @param string $imageName Which image to process
     * @param string $newFilename New filename to save to
     * @return string
     *
     * @throws \Exception
     */
    public function image($imageName, $newFilename)
    {
        $imagePath = $this->imageFolder . $imageName;

        if (!file_exists($imagePath)) {
            throw new \Exception("Cannot find the file `$imagePath`.");
        }

        // Perhaps it's worth checking the mime type or file extension so you can swap to `imagecreatefrompng()` ?

        // Then it might be worth processing different images in different methods within the class?

        $image = imagecreatefromstring(file_get_contents($imagePath));
        $dimensions = getimagesize($image);

        $atomic = imagecolorallocate($image, 70, 73, 74);

        for ($x = 0; $x < $dimensions[0]; $x++) {
            for ($y = 0; $y < $dimensions[1]; $y++) {
                $color = imagecolorat($image, $x, $y);
                $color = imagecolorsforindex($image, $color);
                if ($color['alpha'] !== 127) {
                    imagesetpixel($image, $x, $y, $atomic);
                }
            }
        }

        if (imagepng($image, $this->imageFolder . $newFilename)) {
            imagedestroy($image);
            return "New image was created and saved.";
        }

        return "Could not create a new image.";
    }
}

/**
 * Let's actually run the code!
 */

// Instanciate a new instance of the class
$recolor = new Recolor();

// Call the class method. As it returns void, we don't need to assign it's return value.
$result = $recolor->image('etsy.png', 'atomic.png');
echo $result;