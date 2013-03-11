<?php
/******************************************************************************
 *   Copyright (C) 2012 by Mikhail Cherviakov                                 *
 *   email: htonus@gmail.com                                                  *
 ******************************************************************************/
/* $Id$ */


/**
 * User management controller
 *
 * @author htonus
 */
final class controllerRealty extends i18nEditor
{
	public function __construct()
	{
		parent::__construct(Realty::create());
	}

	protected function attachCollections(HttpRequest $request, Model $model)
	{
//		$model->set(
//			'featureGroupList',
//			FeatureTypeGroup::getAnyObject()->getObjectList()
//		);
		
//		$model->set(
//			'featureTypeList',
//			ArrayUtils::convertObjectList(
//				Criteria::create(FeatureType::dao())->getList()
//			)
//		);
		
		$model->set(
			'realtyTypeList',
			ArrayUtils::convertObjectList(
				Criteria::create(RealtyType::dao())->getList()
			)
		);
		
		$model->set(
			'offerTypeList',
			OfferType::sale()->getObjectList()
		);
		
		$list = $this->getForm()->getValue('id')
			? $this->getForm()->getValue('id')->getFeatureList()
			: array();
		
		$featureList = array();
		foreach ($list as $id => $item) {
			$featureList[$id] = $item->getValue();
		}
		
		$model->set('featureList', $featureList);

		return parent::attachCollections($request, $model);
	}
}
