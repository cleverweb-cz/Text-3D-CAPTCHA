<?php

use CleverWeb\Text3dCaptcha\Format\Png;
use CleverWeb\Text3dCaptcha\Map\GdFont;
use CleverWeb\Text3dCaptcha\Projection\Axonometry;

require __DIR__.'/../vendor/autoload.php';

/**
 * Simple PNG CAPTCHA
 */

$map = new GdFont('ABCD 123');
$image = new Png(new Axonometry($map));
header('Content-Type: '.Png::getMimeType());
$image->save();