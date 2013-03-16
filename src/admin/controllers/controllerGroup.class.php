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
		
		$this->getForm()->add(
			Primitive::set('rule')
		);
	}
	
	protected function addObject(
		HttpRequest $request, Form $form, Identifiable $object
	) {
		$db = DBPool::me()->getLink()->begin();
		
		try {
			$object = parent::addObject($request, $form, $object);
			
			if (!$form->getErrors())
				$this->saveRules($object, $request);
			
			$db->commit();
		} catch (Exception $e) {
			$db->rollback();
		}
		
		return $object;
	}
	
	protected function saveObject(
		HttpRequest $request, Form $form, Identifiable $object
	) {
		$db = DBPool::me()->getLink()->begin();
		
		try {
			$object = parent::saveObject($request, $form, $object);
			
			if (!$form->getErrors())
				$this->saveRules($object, $request);
			
			$db->commit();
		} catch (Exception $e) {
			$db->rollback();
		}
		
		return $object;
	}
	
	private function saveRules(Group $group, HttpRequest $request)
	{
		$ruleList = $group->getRuleList();
		
		$set = $this->getForm()->getValue('rule');
		
		foreach ($set as $resourceId => $accessList) {
			if (empty($ruleList[$resourceId])) {
				$rule = GroupAccess::create()->
					setGroup($group)->
					setResourceId($resourceId);
			} else {
				$rule = $ruleList[$resourceId];
				unset($ruleList[$resourceId]);
			}
			
			$rule->dao()->take(
				$rule->setAccess(array_sum($accessList))
			);
		}
		
		foreach ($ruleList as $rule)
			$rule->dao()->drop($rule);
		
		$group->getRules()->fetch();
		
		return $this;
	}
	
	protected function attachCollections(HttpRequest $request, Model $model)
	{
		$model->set(
			'resourceList',
			Criteria::create(Resource::dao())->getList()
		);

		$model->set('accessPlainList', Access::getNames());

//		$rules = array();
//		if ($group = $this->getForm()->getValue('id')) {
//			foreach ($group->getRules(true)->getList() as $rule) {
//				$rules[$rule->getResourceId()] = $rule->getAccess();
//			}
//		}
//		$model->set('rulePlainList', $rules);

		return parent::attachCollections($request, $model);
	}
}
