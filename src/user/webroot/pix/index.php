<?php
/**
 * Resampling picture utility, expects url like
 *	DOMAIN/p/id.ext
 *	DOMAIN/p/w/h/id.ext
 *
 * TODO: implement cache cleaning on picture update
 */

class NotFoundException extends Exception {/*_*/}
class FoundException extends Exception {/* expects file path to show */}

$mime = null;

try {
	$dir = dirname(__FILE__).'/';
	
	$name = empty($_GET['p']) ? 'dummy.png' : $_GET['p'];
	$w1	= empty($_GET['w']) ? null : $_GET['w'];
	$h1	= empty($_GET['h']) ? null : $_GET['h'];
	
	list($id, $ext) = explode('.', $name);
	$dir .= implode('/', str_split(substr(sprintf('%08d', $id), 0, -2), 2)).'/';
	
	$path = $dir.$name;

	// Requested file does not exist
	if (!file_exists($path))
		throw new NotFoundException();

	// Does not require resampling, let's show original
	if ($w1 + $h1 < 1)
		throw new FoundException($path);
	
	$cachePath = $dir.'cache/';
	$cacheName = "$w1.$h1.$name";

	// Have cached picture let's show
	if (file_exists($cachePath.$cacheName))
		throw new FoundException($cachePath.$cacheName);

	// Let's calculate resampled picture and put it to cache
	$info = getimagesize($path);
	$mime = $info[2];
	
	if (!empty($w1)) {
		$k1 = $w1/$h1;

		$w2 = $info[0];
		$h2 = $info[1];
		$k2 = $w2/$h2;

		$dst = imagecreatetruecolor($w1, $h1);
		$src = call_user_func('imagecreatefrom'.$ext, $path);

		if ($k1 > $k2) {
			$w3 = $w2;
			$h3 = $w2 / $k1;
		} else {
			$w3 = $h2 * $k1;
			$h3 = $h2;
		}

		imagecopyresampled(
			$dst, $src,					// $dst_image, $src_image
			0, 0,						// $dst_x, $dst_y
			floor(($w2 - $w3) / 2), floor(($h2 - $h3) / 2),	// $src_x, $src_y
			$w1, $h1,					// $dst_w, $dst_h
			$w3, $h3					// $src_w, $src_h
		);

		if (!file_exists($cachePath))
			mkdir($cachePath, 0775, true);
		
		call_user_func_array('image'.$ext, array($dst, $cachePath.$cacheName));
		imagedestroy($src);
		imagedestroy($dst);

		throw new FoundException($cachePath.$cacheName);
	} else {
		$file = fopen($path, "rb");

		fpassthru($file);
	}


} catch (FoundException $e) {
	$path = $e->getMessage();

	if (empty($mime)) {
		$info = getimagesize($path);
		$mime = $info[2];
	}

	header('Content-type: '.image_type_to_mime_type($mime));
	readfile($path);

//	$fn=fopen("./imagefile.gif","r");
//	fpassthru($fn);
} catch (NotFoundException $e) {/*_*/}

exit;
