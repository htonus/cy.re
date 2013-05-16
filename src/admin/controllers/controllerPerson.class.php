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
		
		$this->setMethodMapping('access', 'doAccess');
		$this->setAccessMapping('access', Access::UPDATE);
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
			add(
				Primitive::boolean('submit')->
				required()->
				setDefault(false)
			)->
			import($request->getGet())->
			importMore($request->getPost());
		
		$object = $form->getValue('id');
		$mav = ModelAndView::create();
		
		if ($form->getActualValue('submit')) {
			$object->getGroups()->
				fetch()->
				setList($form->getValue('group'))->
				save();
			
			$mav->setView(
				new RedirectView('/?area=person')
			);
		} else {
			$mav->getModel()->
				set('subject', $object)->
//				set('groupList', Criteria::create(Group::dao())->getList())->
				set('resourceList', Criteria::create(Resource::dao())->getList())->
				set('accessPlainList', Access::getNames());
		}
		
		return $mav;
	}

	protected function addObject(
		HttpRequest $request, Form $form, Identifiable $object
	) {
		if ($password = $form->getValue('password')) {
			$object->setPassword(sha1($password));
			$form->drop('password');
			
			$object = parent::addObject($request, $form, $object);
		} else {
			$form->markMissing('password');
		}
		
		return $object;
	}

	public function doSave(HttpRequest $request)
	{
		$password = $this->getForm()->
			importOne('password', $request->getGet())->
			getValue('password');

		if ($password) {
			$this->subject->setPassword(sha1(password));
		} else {
			$this->getForm()->markGood('password');
		}
		
		$this->getForm()->drop('password');

		return parent::doSave($request);
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
