<?php
declare(strict_types=1);

namespace CleverWeb\Text3dCaptcha\Format;

use CleverWeb\Text3dCaptcha\Projection\IProjection;

/**
 * Class Png
 * @package CleverWeb\Text3dCaptcha\Format
 * @author Martin Hozík <martin.hozik@cleverweb.cz>
 */
class Png implements IFormat {

	/**
	 * Png constructor.
	 * @param IProjection $projection
	 * @param int $fg foreground color
	 * @param int $bg background color
	 */
	public function __construct(
		private IProjection $projection,
		public int          $fg = 0,
		public int          $bg = 0xFFFFFF
	) {
	}

	/**
	 * Save image
	 * @param string $filePath
	 */
	public function save(string $filePath = 'php://output'): void {

		$p = $this->projection->transform();
		$image = imagecreatetruecolor($this->projection->getWidth(), $this->projection->getHeight());
		imageantialias($image, true);
		imagefill($image, 0, 0, $this->bg);

		for ($x = 0; $x+1 < count($p); $x++) {
			for ($y = 0; $y+1 < count($p[$x]); $y++) {
				imageline($image, $p[$x][$y][0], $p[$x][$y][1], $p[$x+1][$y+1][0], $p[$x+1][$y+1][1], $this->fg);
			}
		}

		imagepng($image, $filePath);
		imagedestroy($image);
	}

	/**
	 * Return image raw data
	 * @return string
	 */
	public function __toString(): string {
		ob_start();
		$this->save();
		return ob_get_clean();
	}

	/**
	 * Get MIME type
	 * @return string MIME type
	 */
	public static function getMimeType(): string {
		return 'image/png';
	}
}
