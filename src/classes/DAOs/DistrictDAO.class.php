<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-05-01 17:22:37                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class DistrictDAO extends AutoDistrictDAO
	{
		public function getByCity(City $city = null, $isPlain = false)
		{
			$list = array();
			
			if ($city) {
				$list = Criteria::create($this)->
					add(
						Expression::eqId('city', $city)
					)->
					add(
						Expression::eqId('i18n.language', GlobalVar::me()->get('language'))
					)->
					addOrder('i18n.name')->
					getList();
			}
			
			if ($isPlain) {
				$plainList = array();
				
				foreach ($list as $item) {
					$plainList[$item->getId()] = $item->getName();
				}
				
				$list = $plainList;
			}
			
			return $list;
		}
	}
?>