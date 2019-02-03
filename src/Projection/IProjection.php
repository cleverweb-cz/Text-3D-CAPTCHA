<?php
declare(strict_types=1);

namespace CleverWeb\Text3dCaptcha\Projection;

use CleverWeb\Text3dCaptcha\Map\IMap;

/**
 * Interface IProjection for planar projection
 * @package CleverWeb\Text3dCaptcha\Projection
 * @author Martin Hozík <martin.hozik@cleverweb.cz>
 */
interface IProjection {

	public function __construct(IMap $map);

	/**
	 * Transform height map via projection type into plane
	 * @return int[][] ([x][y] = [px, py])
	 */
	public function transform(): array;

	/**
	 * Get projection width
	 * @return int
	 */
	public function getWidth(): int;

	/**
	 * Get projection height
	 * @return int
	 */
	public function getHeight(): int;

}