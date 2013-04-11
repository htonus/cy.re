<?php

	final class i18nHelper extends StaticFactory
	{
		const UC		= 0x01;	// Upper case
		const LC		= 0x02;	// Lower case
		const SC		= 0x04;	// Sentense case
		const TC		= 0x08;	// title case
		
		public static $cases = array(
			'U'	=>	i18nHelper::UC,
			'L'	=>	i18nHelper::LC,
			'S'	=>	i18nHelper::SC,
			'T'	=>	i18nHelper::TC,
		);


		public static function detokenize($content, $flags = 0)
		{
			if (preg_match_all('/_(U|L|S|T)?__([^_]+)___/im', $content, $m)) {
				
				$cases	= $m[1];
				$keys	= $m[2];
				
				$tokens = array_combine($keys, $cases);
				
//				GlobalVar::me()->set('language', Language::dao()->getByCode('ru'));
				$set = Criteria::create(Token::dao())->
					addProjection(
						Projection::property('name')
					)->
					addProjection(
						Projection::property('i18n.value', 'value')
					)->
					add(
						Expression::in('name', $keys)
					)->
					add(
						Expression::eqId('i18n.language', GlobalVar::me()->get('language'))
					)->
					getCustomList();
				
				foreach ($set as $row) {
					$case = '';
					
					if (!empty($tokens[$row['name']])) {
						$case = $tokens[$row['name']];
					}
					
					$content = mb_ereg_replace(
						'_'.$case.'__'.$row['name'].'___',
						isset(i18nHelper::$cases[$case])
							? i18nHelper::changeCase($row['value'], i18nHelper::$cases[$case])
							: $row['value'],
						$content
					);
					
					unset($tokens[$row['name']]);
				}
				
				if (!empty($tokens)) {
					foreach ($tokens as $token => $case) {
						$content = mb_ereg_replace(
							'_[A-Z]?__'.$token.'___',
							self::changeCase($token, i18nHelper::$cases[$case]),
							$content
						);
					}
				}
			}
			
			return $content;
		}
		
		public static function changeCase($string, $flag)
		{
			switch ($flag) {
				case self::UC:
					return mb_convert_case($string, MB_CASE_UPPER);
				case self::LC:
					return mb_convert_case($string, MB_CASE_LOWER);
				case self::SC:
					return ucfirst(self::changeCase($string, self::LC));
				case self::TC:
					return mb_convert_case($string, MB_CASE_TITLE);
			}
			
			return $string;
		}
	}
