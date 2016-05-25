<?php

/**
 *	PHP Imager
 *
 *	Description			Script for PHP that provides resizing, output customization and image caching.
 *	First Release		05.11.2015
 *	Version				1.0.2
 *	License				GPL V3 - http://choosealicense.com/licenses/gpl-v3/
 *  External libs		TimThumb - http://code.google.com/p/timthumb/
 *
 *	Author:				Jany Martelli
 *	Author's Website:	http://www.shambix.com/
 *  Script url:			https://github.com/Jany-M/WP-Imager
 *
 *  @Requirements
 *  The plugin needs the cache_img folder to reside in the root of your website.
 *  Inside the cache_img folder you must create a cache folder, that is writable (try to chmod it to 777 in case script cant write to it)
 *  Inside the cache_img folder you must place the TimThumb script tt.php (and the TimThum config file if you need it, but it's not required)
 *  Include this file
 *
 *  @Params
 *	$width		int		Size of width (no px) - 100	(default)
 *	$height		int		Size of height (no px) - 100 (default)
 *	$crop		int		Type of cropping to perform - 3 (default)
 *						0 =	Resize to Fit exactly specified dimensions (no cropping)
 *	 					1 = Crop and resize to best fit the dimensions
 *						2 =	Resize proportionally to fit entire image into specified dimensions, and add borders if required
 *						3 =	Resize proportionally adjusting size of scaled image so there are no borders gaps
 *
 *	$class		string	class name/names to append to image - NULL (default)
 *	$imgurl		string	URL of some external image (eg. http://www.anothersite.com/image.jpg)
 *	$nohtml		bool	When false,images are wrapped already in their HTML tag <img src="" />, with alt attribute filled with post's title for better SEO. If true, only the image urlis returned - false (default)
 *	$bg_color	int		In case of different cropping type (eg. with borders) or transparent png, you can add your own color (eg. 000000) - ffffff (default)
 *
 *  @Defaults
 *	Function always returns to avoid yet another parameter, so simply echo it in your code.
 *	Caching is done in a cache_img folder, in the root of your website
 *
**/

function php_imager_url(){
	if(isset($_SERVER['HTTPS'])){
	    $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
	}
	else{
	    $protocol = 'http';
	}
	return $protocol . "://" . $_SERVER['HTTP_HOST'];
	// $_SERVER['SERVER_NAME']
}


function php_imager($width=null, $height=null, $imgurl=null, $nohtml=false, $class=null, $crop=null, $bg_color=null, $filter=null) {

	//if($imgurl = null) return;

	// Defaults
	$cache = '/cache_img/';
	$siteurl = php_imager_url();
	$sitecache = $siteurl.$cache;
	require_once ($_SERVER['DOCUMENT_ROOT'].$cache.'tt-conf.php'); // Adjust here your preferred TimThumb defaults

	if($width == '') {
		$width = DEFAULT_WIDTH;
	} else {
		$width_tt = '&w='.$width;
	}
	if($height == '') {
		$height = DEFAULT_HEIGHT;
	} else {
		$height_tt = '&h='.$height;
	}
	if(isset($crop)) {
		$crop_tt = '&zc='.$crop;
	} else {
		$crop = DEFAULT_ZC;
	}
	if(isset($bg_color)) {
		$bg_color_tt = '&cc='.$bg_color.'&ct=0';
	} else {
		$bg_color = DEFAULT_CC;
	}
	if(isset($filter)) {
		$filter_tt = '&f='.$filter;
	} else {
		$filter_tt = '';
	}

	if($class !== '') $printclass = 'class="'.$class.'" ';

	//$imgurl = 'http://beta.houndr.com/assets/img/testimonials/img1.jpg';
	if(preg_match("/(http|https):\/\/(.*?)$/i", $imgurl, $matches) < 1) {
		$newimgurl = 'http:'.$imgurl;
		$imgurl = $newimgurl;
	}

	// Change PNG color

	// Imagick
	/*if(isset($filter)) {
		$targetColor = "#000000";
		$fill = '#'.$filter;
		$tolerance = 30000;
		$im = new Imagick( $imgurl);
		if ($im->paintOpaqueImage ( $targetColor , $fill , $tolerance) ){
		    $im->writeImage($imgurl);
		}
	}*/

	/*
	function colorizeBasedOnAplhaChannnel( $file, $targetR, $targetG, $targetB, $targetName ) {

	    $im_src = imagecreatefrompng( $file );

	    $width = imagesx($im_src);
	    $height = imagesy($im_src);

	    $im_dst = imagecreatefrompng( $file );

	    // Note this:
	    // Let's reduce the number of colors in the image to ONE
	    imagefilledrectangle( $im_dst, 0, 0, $width, $height, 0xFFFFFF );

	    for( $x=0; $x<$width; $x++ ) {
	        for( $y=0; $y<$height; $y++ ) {

	            $alpha = ( imagecolorat( $im_src, $x, $y ) >> 24 & 0xFF );

	            $col = imagecolorallocatealpha( $im_dst,
	                $targetR - (int) ( 1.0 / 255.0  * $alpha * (double) $targetR ),
	                $targetG - (int) ( 1.0 / 255.0  * $alpha * (double) $targetG ),
	                $targetB - (int) ( 1.0 / 255.0  * $alpha * (double) $targetB ),
	                $alpha
	                );

	            if ( false === $col ) {
	                die( 'sorry, out of colors...' );
	            }

	            imagesetpixel( $im_dst, $x, $y, $col );

	        }

	    }

	    imagepng( $im_dst, $targetName);
	    imagedestroy($im_dst);

	}

unlink( dirname ( __FILE__ ) . '/newleaf.png' );
unlink( dirname ( __FILE__ ) . '/newleaf1.png' );
unlink( dirname ( __FILE__ ) . '/newleaf2.png' );

$img = dirname ( __FILE__ ) . '/leaf.png';
colorizeBasedOnAplhaChannnel( $img, 0, 0, 0xFF, 'newleaf1.png' );
colorizeBasedOnAplhaChannnel( $img, 0xFF, 0, 0xFF, 'newleaf2.png' );*/

	// External image URL
	if ($nohtml) {
		$output = $sitecache.'tt.php?src='.$imgurl.$width_tt.$height_tt.$crop_tt.$bg_color_tt.$filter_tt;
	} else {
		$output = '<img src="'.$sitecache.'tt.php?src='.$imgurl.$width_tt.$height_tt.$crop_tt.$bg_color_tt.$filter_tt.'" '.$printclass.'/>';
	}
	return $output;

}
?>
