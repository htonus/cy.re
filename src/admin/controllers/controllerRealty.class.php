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
	const PER_PAGE = 10;
	
	public function __construct()
	{
		parent::__construct(Realty::create());

		$this->getForm()->
			drop('preview')->
			add(
				Primitive::set('feature')
			);
	}
	
	public function handleRequest(HttpRequest $request)
	{
		$request->setAttachedVar(
			'defaultOwner',
			Criteria::create(Person::dao())->
				add(Expression::eq('username', 'esperia'))->
				get()
		);
		
		return parent::handleRequest($request);
	}

	public function doEdit(HttpRequest $request)
	{
		if ($request->hasGetVar('code')) {
			$request->setGetVar(
				'id',
				is_numeric($request->getGetVar('code'))
					? $request->getGetVar('code')
					: StringHelper::me()->getDecode($request->getGetVar('code'))
			);
		}

		return parent::doEdit($request);
	}

	protected function addObject(
		HttpRequest $request, Form $form, Identifiable $object
	) {
		$db = DBPool::me()->getLink();
		$db->begin();

		try {
			$this->updateOwner($request, $form);

			$object = parent::addObject($request, $form, $object);

			if (!$form->getErrors()) {
				$this->saveFeatures($object, $request);
				$db->commit();
			}
			
			$this->subject = $object;
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
			$this->updateOwner($request, $form);
			
			$object = parent::saveObject($request, $form, $object);

			if (!$form->getErrors()) {
				$this->saveFeatures($object, $request);
				$db->commit();
			}
			
			$this->subject = $object;
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
		$model->set('defaultOwner', $request->getAttachedVar('defaultOwner'));
		
		$model->set(
			'countryList',
			CriteriaUtils::getSortedCriteria(Country::dao())->getList()
		);
		
		$regionList = $cityList = $districtlist = array();
		
		if ($city = $this->getForm()->getValue('city')) {
			$country = $city->getCountry();
			
			$cityList = CriteriaUtils::getSortedCriteria(City::dao())->
				add(
					Expression::eqId('country', $country)
				)->
				getList();
			
			$regionList = CriteriaUtils::getSortedCriteria(Region::dao())->
				add(
					Expression::eqId('country', $country)
				)->
				getList();
			
			$districtlist = CriteriaUtils::getSortedCriteria(District::dao())->
				add(
					Expression::eqId('city', $city)
				)->
				getList();
		}
		
		$model->set('cityList', $cityList);
		$model->set('regionList', $regionList);
		$model->set('districtList', $districtlist);

		$model->set(
			'realtyTypeList',
			ArrayUtils::convertObjectList(
				Criteria::create(RealtyType::dao())->
					add(
						Expression::eqId('i18n.language', GlobalVar::me()->get('language'))
					)->
					addOrder('i18n.name')->
					getList()
			)
		);

		$model->set('offerTypeList', OfferType::buy()->getObjectList());

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

	private function updateOwner(HttpRequest $request, Form $form)
	{
		if (!$form->getValue('owner')) {
			$fields = Form::create()->
				add(
					Primitive::set('_owner')->
					setDefault(array())
				)->
				import($request->getPost())->
				getValue('_owner');

			$person = Person::create()->
				setCreated(Timestamp::makeNow())->
				setStatus(PersonStatus::normal());

			foreach ($fields as $field => $value) {
				$person->{'set'.ucfirst($field)}($value);
			}

			if ($person = $person->dao()->add($person)) {
				$form->get('owner')->setValue($person);
			} else {
				throw new Exception('Can not add Owner to setup realty');
			}
		}
		
		return $this;
	}
	
	protected function getRedirectMav(HttpRequest $request)
	{
		return ModelAndView::create()->setView(
			new RedirectView(
				'/index.php?area='.lcfirst(get_class($this->subject))
				.'&action=edit&id='.$this->subject->getId()
			)
		);
	}	
}
