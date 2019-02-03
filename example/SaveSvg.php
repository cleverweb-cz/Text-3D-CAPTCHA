<?php

use CleverWeb\Text3dCaptcha\Format\Svg;
use CleverWeb\Text3dCaptcha\Map\GdFont;
use CleverWeb\Text3dCaptcha\Projection\Axonometry;

require __DIR__.'/../vendor/autoload.php';

/**
 * Save SVG CAPTCHA into file
 */

$map = new GdFont('ABCD 123');
$image = new Svg(new Axonometry($map));
$image->save(__DIR__.'/example.svg');