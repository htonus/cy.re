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
				$tokens	= $m[2];
				
//				GlobalVar::me()->set('language', Language::dao()->getByCode('ru'));
				$set = Criteria::create(Token::dao())->
					addProjection(
						Projection::property('name')
					)->
					addProjection(
						Projection::property('value')
					)->
					add(
						Expression::in('name', $tokens)
					)->
					getCustomList();
				
				$tokens = array_flip($tokens);
				
				foreach ($set as $row) {
					$case = '';
					
					if (isset($cases[$tokens[$row['name']]])) {
						$case = $cases[$tokens[$row['name']]];
					}
					
					$content = mb_ereg_replace(
						'_'.$case.'__'.$row['name'].'___',
						i18nHelper::changeCase($row['value'], i18nHelper::$cases[$case]),
						$content
					);
					
					unset($tokens[$row['name']]);
				}
				
				if (!empty($tokens)) {
					print_r($tokens);
					
					foreach ($tokens as $token => $i) {
						$content = mb_ereg_replace('___'.$token.'___', $token, $content);
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
					return ucfirst($string);
				case self::TC:
					return mb_convert_case($string, MB_CASE_TITLE);
			}
			
			return $string;
		}
	}
