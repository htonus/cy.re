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
class i18nEditor extends CommonEditor
{
	const PER_PAGE = 20;
	
	protected $i18nSubject = null;

	public function __construct($subject)
	{
		parent::__construct($subject);
		
		$this->i18nSubject = 
			call_user_func(array(get_class($subject).'_i18n', 'create'));
	}

	public function handleRequest(\HttpRequest $request)
	{
		$request->setAttachedVar('languageList', Language::dao()->getList());
		
		return parent::handleRequest($request);
	}

	private function i18nSetRequest(HttpRequest $request)
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
		
		$request->setAttachedVar('i18n_ids', $ids);
		$request->setAttachedVar('i18n_fields', $fields);
		
//		// Setup main object with default language
//		foreach ($fields[constant('DEFAULT_LANG_CODE')] as $name => $value) {
//			$request->setPostVar($name, $value);
//		}
		
		return $this;
	}
	
	public function doAdd(HttpRequest $request)
	{
		$this->i18nSetRequest($request);
		return parent::doAdd($request);
	}
	
	protected function addObject(
		HttpRequest $request, Form $form, Identifiable $object
	) {
		$db = DBPool::me()->getLink();
		$db->begin();
		
		try {
			$object = parent::addObject($request, $form, $object);
			
			if (!$form->getErrors()) {
				$this->saveI18n($object, $request);
				$db->commit();
			}
		} catch (Exception $e) {
						print_r($e);
			$db->rollback();
			$form->markWrong('id');
		}
		
		return $object;
	}	

	public function doSave(HttpRequest $request)
	{
		$this->i18nSetRequest($request);
		return parent::doSave($request);
	}
	
	protected function saveObject(
		HttpRequest $request, Form $form, Identifiable $object
	) {
		$db = DBPool::me()->getLink();
		$db->begin();
		
		try {
			$object = parent::saveObject($request, $form, $object);
			
			if (!$form->getErrors()) {
				$this->saveI18n($object, $request);
				$db->commit();
			}
		} catch (Exception $e) {
			$db->rollback();
			$form->markWrong('id');
		}
		
		return $object;
	}
	
	private function saveI18n(Identifiable $subject, HttpRequest $request)
	{
		$languageList = $request->getAttachedVar('languageList');
		$ids = $request->getAttachedVar('i18n_ids');
		$fields = $request->getAttachedVar('i18n_fields');
		
		foreach($ids as $code => $id) {
			if (empty($id)) {
				$i18n = clone $this->i18nSubject;
				$i18n->
					setObject($subject)->
					setLanguage($languageList[$code]);
			} else {
				$i18n = $this->i18nSubject->dao()->getById($id);
			}
			
			foreach ($fields[$code] as $name => $value) {
				$i18n->{'set'.ucfirst($name)}($value);
			}
			
			$i18n->dao()->take($i18n);
		}
	}
	
	protected function attachCollections(HttpRequest $request, Model $model)
	{
		parent::attachCollections($request, $model);
		
		$model->set('languageList', $request->getAttachedVar('languageList'));

		$i18n = array_diff_key(
			$this->i18nSubject->proto()->getMapping(),
			array_flip(array('language', 'object'))
		);
		
		$i18nList = array();
		
		if (
			$model->has('editorResult')
			&& $model->get('editorResult') == PrototypedEditor::COMMAND_FAILED
		) {
			$i18nList = $request->getAttachedVar('i18n_fields');
		} elseif ($this->getForm()->getValue('id')) {
			$list = Criteria::create($this->i18nSubject->dao())->
				add(
					Expression::eqId('object', $this->getForm()->getValue('id'))
				)->
				getList();
			
			foreach ($list as $item) {
				foreach ($i18n as $name => $field)
					$i18nList[$item->getLanguage()->getCode()][$name] =
						$item->{'get'.ucfirst($name)}();
			}
		}
		
		$model->
			set('i18n',$i18n)->
			set('i18nList', $i18nList);

		return $this;
	}
	
	protected function sendJson($data)
	{
		header(
			'Content-type: '
			.ContentTypeHeader::create()->
				setMediaType('text/json')->
				setCharset('utf-8')->
				toString()
		);
		
		echo json_encode($data);
		
		exit;
	}
}
