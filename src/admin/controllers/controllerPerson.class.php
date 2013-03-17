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
		parent::__construct(Person::create()->setCreated(Timestamp::makeNow()));
		
		$this->getForm()->drop('created');
		
		$this->setMethodMapping('access', 'doAccess');
	}
	
	protected function doAccess(HttpRequest $request)
	{
		$form = Form::create()->
			add(
				Primitive::integerIdentifier('id')->
				of('Person')
			)->
			add(
				Primitive::identifierlist('group')->
				of('Group')
			)->
			import($request->getGet())->
			importMore($request->getPost());
		
		$object = $form->getValue('id');
		$mav = ModelAndView::create();
		
		if ($groups = $form->getValue('group')) {
			$object->getGroups()->
				fetch()->
				setList($groups)->
				save();
			
			$mav->setView(
				new RedirectView('/?area=person')
			);
		} else {
			$mav->getModel()->
				set('user', $object)->
//				set('groupList', Criteria::create(Group::dao())->getList())->
				set('resourceList', Criteria::create(Resource::dao())->getList())->
				set('accessPlainList', Access::getNames());
		}
		
		return $mav;
	}
	
	protected function saveObject(
		HttpRequest $request, Form $form, Identifiable $object
	) {
		if ($newPassword = $form->getValue('password')) {
			$object->setPassword(sha1($newPassword));
		} else {
			$object->setPassword($form->getValue('id')->getPassword());
		}
		
		$form->drop('password');
		
		return parent::addObject($request, $form, $object);
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
