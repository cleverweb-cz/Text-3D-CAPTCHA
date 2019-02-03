<?php
declare(strict_types=1);

namespace CleverWeb\Text3dCaptcha\Projection;

use CleverWeb\Text3dCaptcha\Map\IMap;

/**
 * Class Axonometry
 * @package CleverWeb\Text3dCaptcha\Projection
 * @author Martin Hozík <martin.hozik@cleverweb.cz>
 */
class Axonometry implements IProjection {

	/**
	 * @var IMap
	 */
	private $map;
	/**
	 * @var float
	 */
	public $scale;
	/**
	 * @var float
	 */
	public $angle;
	/**
	 * @var array;
	 */
	private $draw;

	/**
	 * Axonometry constructor.
	 * @param IMap $map
	 * @param float $scale scale
	 * @param float $angle axonometric projection angle (rad)
	 */
	public function __construct(IMap $map, float $scale = 5., float $angle = 1.2) {
		$this->map = $map;
		$this->scale = $scale;
		$this->angle = $angle;
	}

	/**
	 * Transform height map via projection type into plane
	 * @return int[][] ([x][y] = [px, py])
	 */
	public function transform(): array {

		$this->draw();
		$w = count($this->draw);
		$h = count(reset($this->draw));
		$p = [];

		for ($x = 0; $x < $w; $x++) {
			$p[$x] = [];
			for ($y = 0; $y < $h; $y++) {
				$p[$x][$y] = [
					intval($x*$this->scale-$y*$this->scale*cos($this->angle)+($h-1)*cos($this->angle)*$this->scale),
					intval($y*$this->scale*sin($this->angle)-$this->draw[$x][$y]*$this->scale)
				];
			}
		}

		return $p;
	}

	/**
	 * Get projection width
	 * @return int
	 */
	public function getWidth(): int {
		$this->draw();
		return intval((count($this->draw)-1)*$this->scale+count(reset($this->draw))*cos($this->angle)*$this->scale);
	}

	/**
	 * Get projection height
	 * @return int
	 */
	public function getHeight(): int {
		$this->draw();
		return intval((count(reset($this->draw))-1)*sin($this->angle)*$this->scale);
	}

	private function draw(): void {
		$this->draw = $this->draw ?? $this->map->draw();
	}
}