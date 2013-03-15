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
final class controllerResource extends CommonEditor
{
	public function __construct()
	{
		parent::__construct(Resource::create());
	}

	protected function attachCollections(HttpRequest $request, Model $model)
	{
		$model->set(
			'resourceTypeList',
			ResourceType::object()->getObjectList()
		);
		
		return parent::attachCollections($request, $model);
	}
}
