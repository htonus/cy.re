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
final class controllerUnit extends CommonEditor
{
	public function __construct()
	{
		parent::__construct(Unit::create());
	}
	
	public function doEdit(HttpRequest $request)
	{
		$mav = parent::doEdit($request);
		$model = $mav->getModel();
		$i18nList = array();
		
		if ($this->getForm()->getValue('id')) {
			$list = Criteria::create(Unit_i18n::dao())->
				add(
					Expression::eqId('object', $this->getForm()->getValue('id'))
				)->
				getList();

			foreach ($list as $item) {
				$i18nList[$item->getLanguageId()] = $item;
			}
		}
		
		$i18n = Unit_i18n::proto()->getMapping();
		
		$model->
			set('i18n',$i18n)->
			set('i18nList', $i18nList);
		
		return $mav;
	}
	
	public function doAdd(HttpRequest $request)
	{
		$form = Form::create()->
			add(
				Primitive::set('i18n_id')
			)->
			add(
				Primitive::set('i18n_field')
			)->
			import($request->getPost());
		
		$ids = $form->getValue('i18n_id');
		$fields = $form->getValue('i18n_field');
		
		foreach ($fields['en'] as $name => $value) {
			$request->setPostVar($name, $value);
		}
		
		$mav = parent::doAdd($request);
		
		$this->saveI18n($mav->getModel()->get('subject'), $ids, $fields);
		
		return $mav;
	}
	
	public function doSave(HttpRequest $request)
	{
		$form = Form::create()->
			add(
				Primitive::set('i18n_id')
			)->
			add(
				Primitive::set('i18n_field')
			)->
			import($request->getPost());
		
		$ids = $form->getValue('i18n_id');
		$fields = $form->getValue('i18n_field');
		
		foreach ($fields['en'] as $name => $value) {
			$request->setPostVar($name, $value);
		}
		
		$mav = parent::doSave($request);
		
		$this->saveI18n($mav->getModel()->get('subject'), $ids, $fields);
		
		return $mav;
	}
	
	private function saveI18n(Unit $subject, $ids, $fields)
	{
		$languageList = Language::dao()->getList();
		
		foreach($ids as $code => $id) {
			if (empty($id)) {
				$i18n = Unit_i18n::create()->
					setObject($subject)->
					setLanguage($languageList[$code]);
			} else {
				$i18n = Unit_i18n::dao()->getById($id);
			}
			
			foreach ($fields[$code] as $name => $value) {
				$i18n->{'set'.ucfirst($name)}($value);
			}
			
			$i18n->dao()->take($i18n);
		}
	}
}
