<?php
declare(strict_types=1);

namespace CleverWeb\Text3dCaptcha\Format;

use CleverWeb\Text3dCaptcha\Projection\IProjection;

/**
 * Class Svg
 * @package CleverWeb\Text3dCaptcha\Format
 * @author Martin Hozík <martin.hozik@cleverweb.cz>
 */
class Svg implements IFormat {

	/**
	 * @var IProjection
	 */
	private $projection;
	/**
	 * @var int
	 */
	public $fg;

	/**
	 * Svg constructor.
	 * @param IProjection $projection
	 * @param int $fg foreground color
	 */
	public function __construct(IProjection $projection, int $fg = 0) {
		$this->projection = $projection;
		$this->fg = $fg;
	}

	/**
	 * Save image
	 * @param string $filePath
	 */
	public function save(string $filePath = 'php://output'): void {

		$p = $this->projection->transform();
		$width = $this->projection->getWidth();
		$height = $this->projection->getHeight();
		$shape = '';

		for ($x = 0; $x+1 < count($p); $x++) {
			for ($y = 0; $y+1 < count($p[$x]); $y++) {
				$shape .= 'M'.$p[$x][$y][0].','.$p[$x][$y][1].'L'.$p[$x+1][$y+1][0].','.$p[$x+1][$y+1][1];
			}
		}

		$stroke = "#".substr("000000".dechex($this->fg), -6);

		$svg = <<<SVG
<?xml version="1.0" encoding="utf-8"?>
<svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="{$width}px" height="{$height}px" x="0px" y="0px" viewBox="0 0 {$width} {$height}">
<path stroke="{$stroke}" d="{$shape}"/>
</svg>
SVG;

		file_put_contents($filePath, $svg);
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
		return 'image/svg+xml';
	}
}