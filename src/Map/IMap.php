<?php
declare(strict_types=1);

namespace CleverWeb\Text3dCaptcha\Map;

/**
 * Interface IMap for height map
 * @package CleverWeb\Text3dCaptcha\Map
 * @author Martin Hozík <martin.hozik@cleverweb.cz>
 */
interface IMap {

	public function __construct(string $value);

	/**
	 * Draw height map
	 * @return float[][] [x][y] = z
	 */
	public function draw(): array;
}