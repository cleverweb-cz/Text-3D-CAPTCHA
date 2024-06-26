<?php
declare(strict_types=1);

namespace CleverWeb\Text3dCaptcha\Map;

/**
 * Class GdFont
 * @package CleverWeb\Text3dCaptcha\Map
 * @author Martin Hozík <martin.hozik@cleverweb.cz>
 */
class GdFont implements IMap {

	/**
	 * GdFont Constructor
	 * @param string $value Text value
	 * @param float $noise intesity
	 * @param float $padding Text padding
	 * @param float $volume Emboss volume
	 * @param int $font identifier (see imageloadfont)
	 */
	public function __construct(
		public string $value,
		public float  $noise = .1,
		public float  $padding = .1,
		public float  $volume = 1,
		public int    $font = 5
	) {
	}

	/**
	 * Draw height map
	 * @return float[][] [x][y] = z
	 */
	public function draw(): array {

		$w = imagefontwidth($this->font)*strlen($this->value);
		$h = imagefontheight($this->font);
		$padding = $h*$this->padding;
		$width = intval($w+4*$padding);
		$height = intval($h+2*$padding);
		$p = imagecreatetruecolor($width, $height);
		imagestring($p, $this->font, intval(2*$padding), intval($padding), $this->value, 0xFF);
		$this->noise($p);

		$map = [];

		for ($x = 0; $x < $width; $x++) {
			$map[$x] = [];
			for ($y = 0; $y < $height; $y++) {
				$map[$x][$y] = imagecolorat($p, $x, $y)/0xFF*$this->volume;
			}
		}

		imagedestroy($p);
		return $map;
	}

	/**
	 * Add noise into bitmap
	 * @param resource $r
	 */
	protected function noise($r): void {
		if ($this->noise == 0)
			return;

		for ($x = 0; $x < imagesx($r); $x++)
			for ($y = 0; $y < imagesy($r); $y++) {
				imagesetpixel($r, $x, $y, imagecolorat($r, $x, $y)+mt_rand(0, intval($this->noise*0xFF)));
			}
	}
}
