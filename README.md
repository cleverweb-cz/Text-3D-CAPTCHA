# Text 3D CAPTCHA
**Simple axonometric 3D text CAPTCHA**

![Text 3D CAPTCHA](./example/example.svg)

- Creates an axonometric letter projection that is difficult to read for OCR, but easy for humans.
- Uses the built-in bitmap fonts of the PHP GD library to create the source height-map array.
- Random noise is applied to the source map so that the result is not deterministic.
- The output is raster PNG or vector SVG.

---

## Prerequisites

- PHP 8.0+
- [GD library](http://php.net/manual/en/book.image.php)


## Installation

The preferred way to install this library is by using Composer:

```
composer require cleverweb-cz/text-3d-captcha
```

## Usage

### Basic

```php
$map = new GdFont('ABCD 123');
$image = new Svg(new Axonometry($map));
header('Content-Type: '.Svg::getMimeType());
$image->save(); // Output to browser
```

### Custom

```php
/**
 * noise = 0
 * padding = 0.2 (20%)
 * emboss height volume = 0.7 (70%)
 */
$map = new GdFont('ABCD 123', 0, .2, .7);

/**
 * Projection scale = 6x
 * Projection angle = 1.57 rad (90 deg)
 * Foreground color = red
 * Background color = gray
 */
$image = new Png(new Axonometry($map, 6., 1.57), 0xff0000, 0xcccccc);
header('Content-Type: '.Png::getMimeType());
$image->save(); // Output to browser
```

Also check the examples in the `/example` directory.
