<?php

namespace Format;

use CleverWeb\Text3dCaptcha\Format\Svg;
use CleverWeb\Text3dCaptcha\Map\GdFont;
use CleverWeb\Text3dCaptcha\Projection\Axonometry;
use PHPUnit\Framework\TestCase;

class SvgTest extends TestCase {

	public function testBasic() {

		$map = new GdFont('ABCD 123');
		$image = new Svg(new Axonometry($map));

		$data = (string)$image;

		$this->assertIsString($data);
		$this->assertStringContainsStringIgnoringCase('image', Svg::getMimeType());
		$this->assertMatchesRegularExpression('/<svg[^>]*>.+<\/svg>/s', $data);
	}
}
