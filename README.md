# PHP Imager

**PHP Imager** makes image management easier when it comes to manipulating, caching and customizing images.
It has a WordPress twin, [WP-Imager](https://github.com/Jany-M/WP-Imager/)

> Uses **[TimThumb](http://code.google.com/p/timthumb/)** for image resizing and caching

> Caches images in a custom folder, to avoid clutter


## Requirements

- PHP 5.2.x or higher
- GD image library

## Get started

1. Place the provided `cache_img` folder in your site's root folder.

> Make sure that `cache_img/cache` is writable, in case images are not displaying.

2. Include `php-imager.php` where you need it.


```php
<?php include 'php-imager.php'; ?>
```

> If you want to have pretty img urls, then there's an extra step:
> - If you don't have an `.htaccess` yet, place the one provided in your site's root folder.
> - If you already have an `.htaccess`, then adapt it, following the one provided.

**If you don't complete every step the script won't work.**

## Parameters

```php
<?php
php_imager($width=null, $height=null, $imgurl=null, $nohtml=false, $class=null, $crop=null, $bg_color=null);
?>
```

The function returns the value, to print it, echo it.

<table>
  <tr>
    <th>Parameter</th>
    <th>Type</th>
    <th>Description & Options</th>
    <th>Default</th>
  </tr>
  <tr>
    <td><code>width</code></td>
    <td>int</td>
    <td>Resize dimension of width (dont put 'px' after size)</td>
    <td>100</td>
  </tr>
  <tr>
    <td><code>height</code></td>
    <td>int</td>
    <td>Resize dimension of height (dont put 'px' after size)</td>
    <td>100</td>
  </tr>
  <tr>
    <td><code>crop</code></td>
    <td>int</td>
    <td>Type of cropping to perform
    0 = Resize to Fit exactly specified dimensions (no cropping) 	
    1 =	Crop and resize to best fit the dimensions (default)
    2 =	Resize proportionally to fit entire image into specified dimensions, and add borders if required
    3 =	Resize proportionally adjusting size of scaled image so there are no borders gaps</td>
    <td>1</td>
  </tr>
  <tr>
    <td><code>class</code></td>
    <td>string</td>
    <td>class name/names to append to image</td>
    <td>NULL</td>
  </tr>
  <tr>
    <td><code>imgurl</code></td>
    <td>string</td>
    <td>URL of some external/custom image (eg. http://www.mysite.com/image.jpg)	</td>
    <td>NULL</td>
  </tr>
  <tr>
    <td><code>nohtml</code></td>
    <td>bool</td>
    <td>When false,images are wrapped already in their HTML tag <code><img src="#" /></code>, with alt attribute filled with post's title for better SEO. If true, only the image url is returned</td>
    <td>false</td>
  </tr>
  <tr>
    <td><code>bg_color</code></td>
    <td>int</td>
    <td>When using crop value '2' (with borders) you can customize the borders color (the canvas beneath the image).</td>
    <td>ffffff</td>
  </tr>
</table>


## Defaults

- Function always returns to avoid yet another parameter, so simply echo it in your code.
- Processed IMG's quality is always 100
- Caching is done in a cache_img folder, in the root of your website (provided)
- Pretty img urls are enabled by default. Adapt the .htaccess provided with the script.

### Usage

Please refer to its WP twin, [WP-Imager](https://github.com/Jany-M/WP-Imager/)

### Conflicting Params

Clearly there are some parameters you cannot use together.

- <code>$class</code> won't do anything if <code>$nohtml = true</code>


## Changelog

**5/11/2015**


## Credits

TimThumbs (discontinued): [BinaryMoon](http://code.google.com/p/timthumb/)

## Author

Jany Martelli @ [Shambix](http://www.shambix.com)

## License

Released under the [GPL v3 License](http://choosealicense.com/licenses/gpl-v3/)