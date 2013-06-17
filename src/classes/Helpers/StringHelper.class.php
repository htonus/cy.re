<?php

	final class StringHelper extends Singleton
	{
		private $code = '123456789WERTYUPASDFGHJKZXCVBNMQ';

		/**
		 * @return StringHelper
		 */
		public static function me()
		{
			return self::getInstance(__CLASS__);
		}

		public function getCode(Realty $realty)
		{
			$len = strlen($this->code);
			$out = $prefix = '';
			$id = $realty->getId();

			while ($id > 0) {
				$out = $this->code[$id % $len] . $out;
				$id = floor($id  / $len);
			}

			$prefix .= $realty->getCity()
				&& $realty->getCity()->getPrefix()
					? $realty->getCity()->getPrefix()
					: 'OO';

			$prefix .= $realty->getRealtyType()
				&& $realty->getRealtyType()->getPrefix()
					? $realty->getRealtyType()->getPrefix()
					: 'O';

			return $prefix.$out;
		}
		
		public function getDecode($str)
		{
			$str = strtoupper(substr($str, 3));
			$str = str_replace(array('0', 'O', 'L'), array('', '', '1'), $str);
			$code = array_flip(str_split($this->code, 1));
			$cnt = count($code);
			$out = 0;

			for ($i = 0; $i < strlen($str); $i ++)
				$out = $out * $cnt + $code[$str[$i]];

			return $out;
		}

		public function dump($object, $exit = false, $echo = true, $safe = false)
		{
			if ($echo) {
				echo '<br/><pre>';
				$safe ? print_r($object) : var_dump($object);
				echo '</pre>';
			} else
				return $safe ? print_r($object, true) : var_export($object, true);

			(!$exit) || exit();
		}

		public function cutText($text, $length, $suffix = '...')
		{
			if (mb_strlen($text) < $length)
				return $text;

			$text = mb_substr($text, 0, $length);

			return mb_substr($text, 0, mb_strrpos($text, ' '))." $suffix";
		}
	}