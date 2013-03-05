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
		parent::__construct(Unit::create());
	}

	protected function attachCollections(HttpRequest $request, Model $model)
	{
		$model->set(
			'featureGroupList',
			FeatureTypeGroup::getAnyObject()->getObjectList()
		);
		
		$model->set(
			'featureTypeList',
			FeatureType::dao()->getPlainList()
		);
		
		return parent::attachCollections($request, $model);
	}
}
