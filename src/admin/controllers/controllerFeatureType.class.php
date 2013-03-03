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
final class controllerFeatureType extends i18nEditor
{
	public function __construct()
	{
		parent::__construct(FeatureType::create());
	}
	
	protected function attachCollections(HttpRequest $request, Model $model)
	{
		$model->set(
			'unitList',
			Unit::dao()->getPlainList()
		);
		
		$model->set(
			'groupList',
			FeatureTypeGroup::getAnyObject()->getObjectList()
		);
		
		return parent::attachCollections($request, $model);
	}
}
