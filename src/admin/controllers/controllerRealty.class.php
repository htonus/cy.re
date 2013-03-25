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
final class controllerRealty extends i18nEditor
{
	public function __construct()
	{
		parent::__construct(
			Realty::create()->
				setCreated(Timestamp::makeNow())
		);

		$this->getForm()->
			drop('created')->
			add(
				Primitive::set('feature')
			);
		
		$list = array(
			'get_pictures'	=> 'doGetPictures',
			'add_pictures'	=> 'doAddPictures',
			'drop_picture'	=> 'doDropPicture',
		);
		
		$this->setMethodMappingList($list);
		
		$this->setAccessMapping($list, Access::UPDATE);
	}
	
	protected function doAddPictures(HttpRequest $request)
	{
		$request->setAttachedVar('layout', 'json');
		
		$form = Form::create()->
			add(
				Primitive::integerIdentifier('id')->
				of('Realty')
			)->
			add(
				Primitive::set('files')
			)->
			import($request->getGet())->
			importMore($request->getPost())->
			importMore($request->getFiles());
		
		$mav = ModelAndView::create();
		
		if ($files = $form->getValue('files')) {
			
		}
	}
	
	protected function doGetPictures(HttpRequest $request)
	{
		$request->setAttachedVar('layout', 'json');
		
		$form = Form::create()->
			add(
				Primitive::integerIdentifier('id')->
				of('Realty')
			)->
			import($request->getGet())->
			importMore($request->getPost());
		
		$mav = ModelAndView::create();
		$out = array();
		
		foreach ($form->getValue('id')->getPictures()->getList() as $picture) {
			$out[] = array(
				'delete_type'	=> 'DELETE',
				'delete_url'	=> '/?area=realty&action=drop_picture&id='.$picture->getId(),
				'name'			=> $picture->getName(),
				'size'			=> $picture->getSize(),
				'thumbnail_url'	=> $picture->getThumbnailUrl(),
				'type'			=> $picture->getType()->getMimeType(),
				'url'			=> $picture->getUrl(),
			);
		}
		
		return $mav->setModel(
			Model::create()->set('data', array('files', $out))
		);
	}
	
	protected function addObject(
		HttpRequest $request, Form $form, Identifiable $object
	) {
		$db = DBPool::me()->getLink();
		$db->begin();
		
		try {
			$object = parent::addObject($request, $form, $object);

			if (!$form->getErrors()) {
				$this->saveFeatures($object, $request);
				$this->savePictures($object, $request);
				$db->commit();
			}
		} catch (Exception $e) {
			$db->rollback();
			$form->markCustom('id', $e->getMessage());
		}
		
		return $object;
	}

	private function saveFeatures(Realty $object, HttpRequest $request)
	{
		$set = $this->getForm()->getValue('feature');
		$list = $object->getFeatureList();

		// Update or create features
		foreach ($set as $typeId => $value) {
			if (empty($list[$typeId])) {
				$feature = Feature::create()->
					setTypeId($typeId)->
					setRealty($object);
			} else {
				$feature = $list[$typeId];
				unset($list[$typeId]);
			}
			
			if (empty($value)) {
				if ($feature->getId())
					$feature->dao()->drop($feature);
			} else {
				$feature->dao()->take(
					$feature->setValue($value)
				);
			}
		}

		// Drop empty features
		foreach ($list as $typeId => $feature)
			$feature->dao()->drop($feature);

		// Update lists
		$object->getFeatures()->fetch();

		return $this;
	}

	private function savePictures(Realty $object, HttpRequest $request)
	{

	}

	protected function attachCollections(HttpRequest $request, Model $model)
	{
//		$model->set(
//			'featureGroupList',
//			FeatureTypeGroup::getAnyObject()->getObjectList()
//		);
		
		$model->set(
			'cityList',
			Criteria::create(City::dao())->getList()
		);
		
		$model->set(
			'realtyTypeList',
			ArrayUtils::convertObjectList(
				Criteria::create(RealtyType::dao())->getList()
			)
		);
		
		$model->set(
			'offerTypeList',
			OfferType::sale()->getObjectList()
		);
		
		$list = $this->getForm()->getValue('id')
			? $this->getForm()->getValue('id')->getFeatureList()
			: array();
		
		$featureList = array();
		foreach ($list as $id => $item) {
			$featureList[$id] = $item->getValue();
		}
		
		$model->set('featureList', $featureList);

		return parent::attachCollections($request, $model);
	}
}
