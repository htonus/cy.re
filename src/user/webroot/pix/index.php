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

define ('PADDING', 2);

$mime = null;

try {
	$name = empty($_GET['p']) ? 'dummy.png' : $_GET['p'];
	$w1	= empty($_GET['w']) ? null : $_GET['w'];
	$h1	= empty($_GET['h']) ? null : $_GET['h'];
	
	list($id, $ext) = explode('.', $name);
	$idPath = implode('/', str_split(substr(sprintf('%08d', $id), 0, -2), 2)).'/';
	
	$base = dirname(__FILE__).'/';
	$filePath = $base.$idPath;
	$cachePath = $base.'cache/'.$idPath;
	$path = $filePath.$name;

	// Requested file does not exist
	if (!file_exists($path))
		throw new NotFoundException();

	// Does not require resampling, let's show original
	if ($w1 + $h1 < 1)
		throw new FoundException($path);
	
	$cacheName = "$id.$w1-$h1.$ext";

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

		// If we have vertical picture, don't cut
		if ($k2 < 1) {
			
			// Too narow, let us cut
			if ($k2 < 0.25) {
				$h3 = $w2 / 0.5;
			} else {
				$h3 = $h2;
			}
			
			$w3 = $w2 * $h1 / $h3;
			
			imagefill($dst, 0, 0, imagecolorallocate($dst, 0x44, 0x44, 0x44));
			
			imagecopyresampled(
				$dst, $src,					// $dst_image, $src_image
				($w1 - $w3) / 2, 0,			// $dst_x, $dst_y
				0, ($h2 - $h3) / 2,			// $src_x, $src_y
				$w3, $h1,					// $dst_w, $dst_h
				$w2, $h3					// $src_w, $src_h
			);
			
			// Nice white lines from left and right sides of the picture
			$white	= imagecolorallocate($dst, 0xFF, 0xFF, 0xFF);
			$left	= ($w1 - $w3) / 2 - PADDING;
			$right	= ($w1 + $w3) / 2 + PADDING;
			imagesetthickness($dst, PADDING);
			imageline($dst, $left, 0, $left, $h1, $white);
			imageline($dst, $right, 0, $right, $h1, $white);
		} else {
			// Square or landscape picture
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
				($w2 - $w3) / 2, ($h2 - $h3) / 2,	// $src_x, $src_y
				$w1, $h1,					// $dst_w, $dst_h
				$w3, $h3					// $src_w, $src_h
			);
		}
		
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
