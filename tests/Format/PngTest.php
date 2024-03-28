<?php

namespace Format;

use CleverWeb\Text3dCaptcha\Format\Png;
use CleverWeb\Text3dCaptcha\Map\GdFont;
use CleverWeb\Text3dCaptcha\Projection\Axonometry;
use PHPUnit\Framework\TestCase;

class PngTest extends TestCase {

	public function testBasic() {

		$map = new GdFont('ABCD 123');
		$image = new Png($axon = new Axonometry($map));

		$data = (string)$image;
		$size = getimagesizefromstring($data);

		$this->assertIsString($data);
		$this->assertStringContainsStringIgnoringCase('image', Png::getMimeType());
		$this->assertIsArray($size);
		$this->assertEquals($axon->getWidth(), $size[0]);
		$this->assertEquals($axon->getHeight(), $size[1]);
	}
}
