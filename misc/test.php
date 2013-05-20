<?php



function code($num)
{
	$code = '123456789WERTYUPASDFGHJKLZXCVBNM';
	$len = strlen($code);
	$out = '';

	while($num > 0) {
		$out = $code[$num % $len] . $out;
		$num = floor($num  / $len);
	}

	return str_repeat('0', 4 - strlen($out)).$out;
}

function decode($str)
{
	$str = preg_replace('/^[o0]*/i', '', $str);
	$code = array_flip(str_split('123456789WERTYUPASDFGHJKLZXCVBNM', 1));
	$cnt = count($code);
	$out = 0;

	for ($i = 0; $i < strlen($str); $i ++)
		$out = $out * $cnt + $code[$str[$i]];

	return $out;
}

$num = 10000;
$str = code($num);
$code = decode($str);

echo "in: $num\n";
echo "code: $str\n";
echo "out: $code\n";
