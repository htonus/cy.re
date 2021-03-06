<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-03-07 20:01:46                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	abstract class i18n extends Autoi18n implements Prototyped
	{
		private $i18nMapping = array();	// getter => $value

		private $bypass = array(
			'id'		=> 1,
			'language'	=> 2,
			'object'	=> 3,
		);

		public function __call($name, $arguments)
		{
			$i18n = $this->getI18nByLanguage();

			Assert::isIndexExists($i18n, $name);

			return $i18n[$name];
		}

		public function getI18nByLanguage(Language $lang = null)
		{
			if (empty($this->i18nMapping)) {
				if (!$lang)
					$lang = GlobalVar::me()->get('language');

				$i18nDefault = null;
				$i18nLanguage = null;
				
				foreach ($this->getI18n()->getList() as $item) {
					$code = $item->getLanguage()->getCode();
					
					if ($code == DEFAULT_LANG_CODE)
						$i18nDefault = $item;

					if ($code == $lang->getCode())
						$i18nLanguage = $item;
				}
								
				foreach ($i18nLanguage->proto()->getPropertyList() as $name => $property) {
					if (isset($this->bypass[$name]))
						continue;
					
					$getter = $property->getGetter();

					if ($value = $i18nLanguage->$getter()) {
						$this->i18nMapping[$getter] = $value;
					} else {
						$this->i18nMapping[$getter] = $i18nDefault->$getter();
					}
				}
			}
			
			return $this->i18nMapping;
		}
	}
?>