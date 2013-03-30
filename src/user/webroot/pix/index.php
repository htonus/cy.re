<?php

try {
	$dir = dirname(__FILE__).'/';

	if (!empty($_GET['p'])) {
		list($id, $ext) = explode('.', $_GET['p']);
		$dir .= implode('/', str_split(substr(sprintf('%08d', $id), 0, -2), 2)).'/';
		$name = "$id.$ext";
	} else {
		$name = 'dummy.png';
	}

	$path = $dir.$name;

	if (!file_exists($path)) {
		exit;
	}

	$info = getimagesize($path);
	header('Content-type: '.image_type_to_mime_type($info[2]));
	
	if (!empty($_GET['w'])) {
		$w1 = intval($_GET['w']);
		$h1 = intval($_GET['h']);
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
