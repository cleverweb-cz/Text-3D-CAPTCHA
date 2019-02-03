<?php

use CleverWeb\Text3dCaptcha\Format\Png;
use CleverWeb\Text3dCaptcha\Map\GdFont;
use CleverWeb\Text3dCaptcha\Projection\Axonometry;

require __DIR__.'/../vendor/autoload.php';

/**
 * Custom PNG CAPTCHA
 * noise = 0
 * padding = 0.2 (20%)
 * emboss height volume = 0.7 (70%)
 */
$map = new GdFont('ABCD 123', 0, .2, .7);

/**
 * Projection scale = 6x
 * Projection scale = 1.57 rad (90 deg)
 * Foreground color = red
 * Background color = gray
 */
$image = new Png(new Axonometry($map, 6., 1.57), 0xff0000, 0xcccccc);
header('Content-Type: '.Png::getMimeType());
$image->save();