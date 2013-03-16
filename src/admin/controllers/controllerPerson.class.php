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
final class controllerPerson extends CommonEditor
{
	public function __construct()
	{
		parent::__construct(Person::create());
	}
	
	protected function attachCollections(HttpRequest $request, Model $model)
	{
		$model->set(
			'groupList',
			Criteria::create(Group::dao())->getList()
		);
		
		$model->set(
			'statusList',
			PersonStatus::normal()->getObjectList()
		);
		
		return parent::attachCollections($request, $model);
	}
}
