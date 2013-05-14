<?php

	final class CriteriaUtils extends StaticFactory
	{
//		public static function me()
//		{
//			return parent::getInstance(__CLASS__);
//		}
		
		/**
		 * Ordered list by i18n properties with language filter
		 * @param StorableDAO $dao
		 * @param mixed $order string or OrderBy
		 * @return array of the objects
		 */
		public static function getList($dao, $order = null)
		{
			$criteria = Criteria::create($dao);

			if ($dao instanceof i18nDAO) {
				$criteria->add(
					Expression::eqId(
						'i18n.language',
						 GlobalVar::me()->get('language')
					)
				);
			}
			
			if ($order)
				$criteria->addOrder($order);
			
			return $criteria->getList();
		}
	}