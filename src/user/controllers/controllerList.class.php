<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of shared list Controller
 *
 * @author htonus
 */
class controllerList extends controllerMain
{
	const LIST1	= 1;
	const LIST2	= 2;
	const LIST3	= 3;
	const LIST4	= 4;
	const LIST5	= 5;

	protected $listVariant = self::LIST1;

	protected $limits = array(
		self::LIST1	=> 5,
		self::LIST2	=> 20,
		self::LIST3	=> 30,
		self::LIST4	=> 40,
		self::LIST5	=> 20,
	);
	
	public function __construct()
	{
		parent::__construct();
		
		$this->accessObject = Realty::create();

		$this->setAccessRules(
			array(
				'index'		=> Access::LISTS,
				'list'		=> Access::LISTS,
				'item'		=> Access::READ,
				'pdf'		=> Access::PUBLISH,
			)
		);

		$this->setMethodMappingList(
			array(
				'list'		=> 'actionList',
				'item'		=> 'actionItem',
				'pdf'		=> 'actionPdf',
			)
		);
		
		$this->historyName = 'history.realty.'.$this->priceType;
	}

	public function handleRequest(HttpRequest $request)
	{
		return parent::handleRequest($request);
	}
	
	public function actionList(HttpRequest $request)
	{
		$model = Model::create();
		
		$mav = ModelAndView::create()->
			setModel($model);
		
		$this->attachList($request, $model);
		
		return $mav;
	}
	
	public function actionItem(HttpRequest $request)
	{
		$model = Model::create()->
			set('subject', $this->getObject($request, 'Realty'))->
			set('currencyRates', ServiceHelper::create()->getCurrencyRates());
		
		return ModelAndView::create()->
			setModel($model);
	}

	public function actionPdf(HttpRequest $request)
	{
		PdfHelper::me()->make($this->getObject($request, 'Realty'));
		exit;
	}

	protected function attachCollections(HttpRequest $request, ModelAndView $mav)
	{
		$mav->getModel()->
			set(
				'featureTypeList',
				ArrayUtils::convertObjectList(
					FeatureType::dao()->getPlainList()
				)
			);
		
		return parent::attachCollections($request, $mav);
	}
	
	protected function attachList(HttpRequest $request, Model $model)
	{
		$form = Form::create()->
			add(
				Primitive::integer('page')->
				setMin(1)->
				setDefault(1)
			)->
			add(
				Primitive::set('location')->
				addImportFilter(
					Filter::chain()->
						add(Filter::trim())->
						add(Filter::replaceSymbols("'", '"'))->
						add(JsonDecoderFilter::me()->setAssoc(true))
				)
			)->
			add(
				Primitive::integer('list')->
				setMin(self::LIST1)->
				setMax(self::LIST5)->
				setDefault($this->listVariant)
			)->
			add(
				Primitive::set('f')
			);

		$fields = array('realtyType', 'city');
		
		foreach($fields as $field) {
			$form->add(
				Primitive::identifier($field)->
				of(ucfirst($field))
			);
		}

		$form->import($request->getGet());
		$this->listVariant = $form->getActualValue('list');
		$filters = $form->getValue('f');
		$orLogic = Expression::orBlock();
		$filterNumber = 0;

		// Attach active fetaures to filter query
		foreach(FeatureType::dao()->getPlainList() as $type) {
			$typeId = $type->getId();
			
			if (empty($filters[$typeId]))
				continue;
			
			$andBlock = Expression::andBlock()->
				expAnd(
					Expression::eq('features.type', $typeId)
				);

			if (preg_match('/-/', $filters[$typeId])) {
				$parts = explode('-', $filters[$typeId]);
				
				$expression = Expression::chain();

				if (!empty($parts[0])) {
					$andBlock->expAnd(
						Expression::gtEq('features.value', $parts[0])
					);
				}

				if (!empty($parts[1])) {
					$andBlock->expAnd(
						Expression::ltEq('features.value', $parts[1])
					);
				}
			} else {
				$andBlock->expAnd(
					Expression::eq('features.value', $filters[$typeId])
				);
			}

			$orLogic->expOr($andBlock);
			$filterNumber ++;
		}
		
		$logic = Expression::chain()->
			expAnd(
				Expression::notNull('published')
			);

		// Add priceType condition to separate offers (buy/rent/shortRent)
		if (empty($filters[$this->priceType]))
			$logic->expAnd(
				Expression::andBlock (
					Expression::eq('features.type', $this->priceType),
					Expression::notNull('features.value')
				)
			);

		// city and realtyType now
		foreach ($fields as $field) {
			if ($value = $form->getValue($field)) {
				$model->set('city', $value);
				$logic->expAnd(
					Expression::eqId($field, $value)
				);
			}
		}
		
		$projection = Projection::chain()->
			add(
				Projection::count('features.id', 'relevance')
			)->
			add(
				Projection::property('id')
			)->
			add(
				Projection::group('id')
			);

		if ($orLogic->getSize()) {
			$logic->expAnd($orLogic);

			if (!defined('RELEVANT_SEARCH')) {
				$projection->add(
					Projection::having(
						Expression::eq(
							SQLFunction::create('count', 'features.id'),
							$filterNumber
						)
					)
				);
			}
		}
		
		$page = $form->getActualValue('page');

		// Total rows (for pager
		$total = Criteria::create(Realty::dao())->
			setProjection(
				Projection::count('id', 'count')
			)->
			add($logic)->
			getCustom('count');

		// Cuurent page ids
		$criteria = Criteria::create(Realty::dao())->
			setProjection($projection)->
			add($logic)->
			setLimit($this->limits[$this->listVariant])->
			setOffset(
				($page - 1) * $this->limits[$this->listVariant]
			);

		// If client choosed search by location
		if ($location = $form->getValue('location')) {
			$model->set('location', $location);

			switch ($location['type']) {
				case 'circle':
					$criteria->add(
						Expression::isTrue(
							SQLFunction::create(
								'is_in_earth_circle',
								DBField::create('latitude')->castTo('float'),
								DBField::create('longitude')->castTo('float'),
								DBValue::create($location['center'][0])->castTo('float'),
								DBValue::create($location['center'][1])->castTo('float'),
								DBValue::create($location['radius'])->castTo('float')
							)
						)
					);
					$center = array($location['center'][0], $location['center'][1]);
					break;
				case 'rectangle':
					$criteria->add(
						Expression::andBlock(
							Expression::between(
								DBField::create('latitude')->castTo('float'),
								DBValue::create($location['left'][0])->castTo('float'),
								DBValue::create($location['right'][0])->castTo('float')
							),
							Expression::between(
								DBField::create('longitude')->castTo('float'),
								DBValue::create($location['left'][1])->castTo('float'),
								DBValue::create($location['right'][1])->castTo('float')
							)
						)
					);
					$center = array(
						abs($location['left'][0] + $location['right'][0]) / 2,
						abs($location['left'][1] + $location['right'][1]) / 2,
					);
					break;
			}
		}
		
		if (defined('RELEVANT_SEARCH')) {
			$criteria->addOrder(
				OrderBy::create(DBField::create('relevance'))->desc()
			);
		} elseif (!empty($center)) {
			$criteria->addOrder(
				OrderBy::create(
					SQLFunction::create(
						'get_earth_distance',
						DBField::create('latitude')->castTo('float'),
						DBField::create('longitude')->castTo('float'),
						DBValue::create($center[0])->castTo('float'),
						DBValue::create($center[1])->castTo('float')
					)
				)->
				asc()
			);
		} else {
			// if there is some other order (by price, e.t.c.)
		}

//		echo '<br/><br/><br/>'.$criteria->toString();
//		exit;

		// Proper order for the list
		$relevance = ArrayHelper::toKeyValueArray(
			$criteria->getCustomList(), 'id', 'relevance'
		);

		$list = array();


		// Take real realty sites for the current page by Ids
		if (!empty($relevance)) {
			// to iterate through this list and show details from realtyList by id
			arsort($relevance);
			
			$logic = Expression::in('id', array_keys($relevance));
			$list = ArrayUtils::convertObjectList(Realty::dao()->getListByLogic($logic));
		}

		$query = array('f' => $filters);

		foreach($fields as $field) {
			if ($value = $form->getValue($field))
				$query[$field] = $value;
		}
		
		$pagerModel = Model::create()->
			set(
				'url',
				PATH_WEB.$this->section->getSlug().'/list?'
				.(empty($filters) ? '' : http_build_query($query))
				.(empty($location) ? '' : '&location='.$form->getRawValue('location'))
				.'&list='.$this->listVariant
			)->
			set('pages', ceil($total / $this->limits[$this->listVariant]))->
			set('page', $page);

		$model->
			set('listVariant', $this->listVariant)->
			set('listVariantList', $this->limits)->
			set('pager', $pagerModel)->
			set('filter', $filters)->
			set('list', $relevance)->
			set('objectList', $list);

		return $this;
	}
}
