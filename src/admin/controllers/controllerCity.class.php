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
final class controllerCity extends i18nEditor
{
	public function __construct()
	{
		parent::__construct(City::create());
	}
	
	protected function attachCollections(HttpRequest $request, Model $model)
	{
		$model->set('countryList', Criteria::create(Country::dao())->getList());
		$model->set('cityList', Criteria::create(City::dao())->getList());
		
		return parent::attachCollections($request, $model);
	}
}
