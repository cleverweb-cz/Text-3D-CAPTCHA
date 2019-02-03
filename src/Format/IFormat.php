<?php
declare(strict_types=1);

namespace CleverWeb\Text3dCaptcha\Format;

use CleverWeb\Text3dCaptcha\Projection\IProjection;

/**
 * Interface IFormat for image output
 * @package CleverWeb\Text3dCaptcha\Format
 * @author Martin Hozík <martin.hozik@cleverweb.cz>
 */
interface IFormat {

	public function __construct(IProjection $projection);

	/**
	 * Save image
	 * @param string $filePath
	 */
	public function save(string $filePath = 'php://output'): void;

	/**
	 * Return image raw data
	 * @return string
	 */
	public function __toString(): string;

	/**
	 * Get MIME type
	 * @return string MIME type
	 */
	public static function getMimeType(): string;
}