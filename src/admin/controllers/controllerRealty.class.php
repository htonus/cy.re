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
	const ERROR_NO_CITY = 'set city first';

	public function __construct()
	{
		parent::__construct(	Realty::create());

		$this->getForm()->
			drop('preview')->
			add(
				Primitive::set('feature')
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
				$db->commit();
			}
		} catch (Exception $e) {
			$db->rollback();
			$form->markCustom('id', $e->getMessage());
		}

		return $object;
	}

	protected function saveObject(
		HttpRequest $request, Form $form, Identifiable $object
	) {
		$db = DBPool::me()->getLink();
		$db->begin();

		try {
			$object = parent::saveObject($request, $form, $object);

			if (!$form->getErrors()) {
				$this->saveFeatures($object, $request);
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
		$set = (array)$this->getForm()->getValue('feature');
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

	protected function hasPublishError(Identifiable $object, Form $form)
	{
		$error = parent::hasPublishError($object, $form);

		if (!$object->getCity()) {
			$error .= ' '.self::ERROR_NO_CITY;
		}
		
		return $error;
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
			'districtList',
			District::dao()->getByCity($model->get('subject')->getCity())
		);

		$model->set(
			'realtyTypeList',
			ArrayUtils::convertObjectList(
				Criteria::create(RealtyType::dao())->getList()
			)
		);

		$model->set(
			'offerTypeList',
			OfferType::buy()->getObjectList()
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
	
	protected function getListCriteria(HttpRequest $request, Model $model)
	{
		$criteria = parent::getListCriteria($request, $model);
		$filter = array();

		foreach ($request->getGet() as $name => $value) {
			if (
				preg_match('|^filter\:(.*)$|', $name, $m)
				&& !empty($value)
			) {
				$filter[$name] = $value;

				switch($m[1]) {
					case 'name':
						// implement me
						break;
					case 'published':
						$criteria->add(
							'yes' == $value
								? Expression::notNull($m[1])
								: Expression::isNull($m[1])
						);
						break;
					case 'code':
					case 'city':
					case 'offerType':
					case 'realtyType':
						$criteria->add(
							Expression::eq($m[1], $value)
						);
						break;
					case 'created_from':
					case 'published_from':
						$criteria->add(
							Expression::gtEq(
								preg_replace('_from', '', $m[1]),
								Date::create($value)->toDate('-')
							)
						);
						break;
					case 'created_to':
					case 'published_to':
						$criteria->add(
							Expression::ltEq(
								preg_replace('_from', '', $m[1]),
								Date::create($value)->toDate('-')
							)
						);
						break;
				}
			} elseif (
				$name == 'sort'
				&& !empty($value)
			) {
				list($sort, $way) = explode(':', $value);
				
				if ($way != 'asc' && $way != 'desc')
					$way = 'asc';
				
				$criteria->
					dropOrder()->
					addOrder(
						OrderBy::create($sort)->$way()
					);
				
				$model->set('sort', $value);
			}
		}
		
		if (!empty($filter))
			$model->set('filter', $filter);
		
		return $criteria;
	}
}
