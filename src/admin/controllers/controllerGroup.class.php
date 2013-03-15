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
final class controllerGroup extends CommonEditor
{
	public function __construct()
	{
		parent::__construct(Group::create());
	}

	protected function attachCollections(HttpRequest $request, Model $model)
	{
		$model->set(
			'resourceList',
			Criteria::create(Resource::dao())->getList()
		);

		$model->set(
			'accessTypeList',
			AccessType::add()->getObjectList()
		);

		$rules = array();
		if ($group = $this->getForm()->getValue('id')) {
			foreach ($group->getRules()->getList() as $rule) {
				if (!isset($rules[$rule->getResourceId()]))
					$rules[$rule->getResourceId()] = array();

				$rules[$rule->getResourceId()][$rule->getAccessId()] = 1;
			}
		}
		$model->set('rulePlainList', $rules);

		return parent::attachCollections($request, $model);
	}
}
