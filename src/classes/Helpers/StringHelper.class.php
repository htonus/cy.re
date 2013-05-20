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

		public function getCode($id)
		{
			$len = strlen($this->code);
			$out = '';

			while ($id > 0) {
				$out = $this->code[$id % $len] . $out;
				$id = floor($id  / $len);
			}

			return str_repeat('O', 4 - strlen($out)).$out;
		}
		
		public function getDecode($str)
		{
			$str = str_replace(array('0', 'O', 'L'), array('', '', '1'), strtoupper($str));
			$code = array_flip(str_split($this->code, 1));
			$cnt = count($code);
			$out = 0;

			for ($i = 0; $i < strlen($str); $i ++)
				$out = $out * $cnt + $code[$str[$i]];

			return $out;
		}
	}