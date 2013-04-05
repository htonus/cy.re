<?php

try {
	$dir = dirname(__FILE__).'/';

	if (preg_match('|^/pix/([^/]+)/?([^/]+)?/?([^/]+)?|i', $_SERVER['REQUEST_URI'], $m)) {
		if (empty($m[3])) {
			$name = $m[1];
		} else {
			$name = $m[3];
			$w1 = intval($m[1]);
			$h1 = intval($m[2]);
		}
	} else {
		$name = 'dummy.png';
	}

	list($id, $ext) = explode('.', $name);
	$dir .= implode('/', str_split(substr(sprintf('%08d', $id), 0, -2), 2)).'/';

	$path = $dir.$name;
	
	if (!file_exists($path)) {
		exit;
	}
	
	$info = getimagesize($path);
	header('Content-type: '.image_type_to_mime_type($info[2]));
	
	if (!empty($w1)) {
		$k1 = $w1/$h1;
		
		$w2 = $info[0];
		$h2 = $info[1];
		$k2 = $w2/$h2;
		
		$dst = imagecreatetruecolor($w1, $h1);
		$src = call_user_func('imagecreatefrom'.$ext, $path);
		
		if ($k1 > $k2) {
			$w3 = $w2;
			$h3 = $h2/$k1;
		} else {
			$w3 = $w2/$k1;
			$h3 = $h2;
		}
		
		imagecopyresampled(
			$dst, $src,					// $dst_image, $src_image
			0, 0,						// $dst_x, $dst_y
			floor(($w2 - $w3) / 2), floor(($h2 - $h3) / 2),	// $src_x, $src_y
			$w1, $h1,					// $dst_w, $dst_h
			$w3, $h3					// $src_w, $src_h
		);
		
		call_user_func('image'.$ext, $dst);
		
	} else {
		$file = fopen($path, "rb");
		
		fpassthru($file);
	}
} catch (Exception $e) {/*_*/}

exit;
