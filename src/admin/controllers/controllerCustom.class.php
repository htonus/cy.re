<?php
/******************************************************************************
 *   Copyright (C) 2012 by Mikhail Cherviakov                                 *
 *   email: htonus@gmail.com                                                  *
 ******************************************************************************/
/* $Id$ */


/**
 * Articles management controller
 *
 * @author htonus
 */
final class controllerCustom extends CommonEditor
{
	public function __construct()
	{
		parent::__construct(Custom::create());

		$this->map->addSource('type', RequestType::get());
		$this->map->addSource('type', RequestType::post());

		$this->map->addSource('section', RequestType::get());
		$this->map->addSource('section', RequestType::post());

		$this->setMethodMapping('list', 'doList');
		$this->setMethodMapping('searchObject', 'doSearch');

		$this->setAccessMapping('list', Access::UPDATE);
		$this->setAccessMapping('searchObject', Access::READ);
	}

	public function beforeHandle(HttpRequest $request)
	{
		$type = $this->map->importOne('type', $request)->
			getForm()->
				getValue('type');

		if ($type)
			$request->setAttachedVar('customType', $type);

		$section = $this->map->importOne('section', $request)->
			getForm()->
				getValue('section');

		if ($section)
			$request->setAttachedVar('section', $section);
		
		return parent::beforeHandle($request);
	}

	protected function doSearch(HttpRequest $request)
	{
		$form = Form::create()->
			add(
				Primitive::string('object')
			)->
			add(
				Primitive::string('criteria')
			)->
			import($request->getGet());

		$idCode = $form->getValue('criteria');
		$object = $form->getValue('object');
		$dao = call_user_func(array($object, 'dao'));
		
		if (is_numeric($idCode) && (intval($idCode) == $idCode)) {
			$item = Criteria::create($dao)->
				add(
					Expression::eq('id', $idCode)
				)->
				get();
		}

		if (empty($item) && $object == 'Realty') {
			$item = Criteria::create($dao)->
				add(
					Expression::eq('id', StringHelper::me()->getDecode($idCode))
				)->
				get();
		}

		$data = array('error' => '');

		if (empty($item)) {
			$data['error'] = 'Do not know such '.$object.': '.$idCode;
		} elseif ($preview = $item->getPreview()) {
			$data['item'] = array(
				'id'		=> $item->getId(),
				'object_id'	=> $item->getId(),
				'code'		=> $object == 'Realty' ? $item->getCode() : '',
				'name'		=> $item->getName(),
				'url'		=> PictureSize::thumbnail()->getUrl($preview),
				'type'		=> TextUtils::downFirst($object),
			);
		} else {
			$data['error'] = 'Opted '.$object.' does not have main picture set!';
		}

		$request->setAttachedVar('layout', 'json');

		return ModelAndView::create()->
			setModel(
				Model::create()->set('data', $data)
			);
	}

	protected function addObject(HttpRequest $request, Form $form, Identifiable $object)
	{
		$db = DBPool::me()->getLink();
		$db->begin();

		try {
			$object = parent::addObject($request, $form, $object);

			if ($object->getId()) {
				$this->saveItems($request, $form, $object);
			}

			$db->commit();
		} catch (Exception $e) {
			$db->rollback();
			$form->markWrong('id');
		}

		return $object;
	}

	protected function saveObject(HttpRequest $request, Form $form, Identifiable $object)
	{
		$db = DBPool::me()->getLink();
		$db->begin();

		try {
			$object = parent::saveObject($request, $form, $object);
			
			if ($object->getId()) {
				$this->saveItems($request, $form, $object);
			}
			
			$db->commit();
		} catch (Exception $e) {
			$db->rollback();
			$form->markWrong('id');
		}

		return $object;
	}

	private function saveItems(HttpRequest $request, Form $form, Identifiable $object)
	{
		$itemList = $object->getItems()->getList();
		
		$list = array(
			'realty'	=> array(),
			'article'	=> array(),
		);
		
		foreach ($itemList as $item) {
			if ($item->getRealtyId())
				$list['realty'][$item->getRealtyId()] = $item;
			else
				$list['article'][$item->getArticleId()] = $item;
		}
		
		$listForm = $form->
			add(
				Primitive::set('item')
			)->
			importOne('item', $request->getPost())->
			getValue('item');
		
		// Create result list to store
		$counter = 0;
		foreach ($listForm as $objectArray) {
			list($objectId, $objecType) = each($objectArray);

			if (!empty($list[$objecType][$objectId])) {
				$item = clone $list[$objecType][$objectId];
				unset($list[$objecType][$objectId]);
			} else {
				$item = CustomItem::create()->
					setParent($object)->
					setObjectId($objecType, $objectId);
			}
			
			$item->dao()->take($item->setOrder(++$counter));
		}

		foreach ($list as $type => $items)
			foreach ($items as $item)
				$item->dao()->drop($item);
		
		$object->getItems()->fetch();
		
		return $object;
	}
	
	protected function getRedirectMav(HttpRequest $request)
	{
		return ModelAndView::create()->setView(
			new RedirectView(
				'/index.php?area=custom'
				.(
					$request->hasAttachedVar('customType')
						? '&type='.$request->getAttachedVar('customType')->getId()
						: null
				)
				.(
					$request->hasAttachedVar('section')
						? '&section='.$request->getAttachedVar('section')->getId()
						: null
				)
			)
		);
	}
	
	protected function getListCriteria(HttpRequest $request, Model $model)
	{
		$criteria = parent::getListCriteria($request, $model);

		if ($request->hasAttachedVar('customType'))
			$criteria->add(
				Expression::eqId('type', $request->getAttachedVar('customType'))
			);

		if ($request->hasAttachedVar('section'))
			$criteria->add(
				Expression::eqId('section', $request->getAttachedVar('section'))
			);

		return $criteria;
	}	
	
	protected function attachCollections(HttpRequest $request, Model $model)
	{
		parent::attachCollections($request, $model);

		$model->set('customTypeList', CustomType::carousel()->getObjectList());

		$model->set('sectionList', Section::buy()->getObjectList());

		if ($request->hasAttachedVar('customType'))
			$model->set('customType', $request->getAttachedVar('customType'));

		if ($request->hasAttachedVar('section'))
			$model->set('section', $request->getAttachedVar('section'));

		return $this;
	}
}
