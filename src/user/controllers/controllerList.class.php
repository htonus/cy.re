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

	protected $listVariant = self::LIST2;

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
			set('subject', $this->getObject($request, 'Realty'));
		
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
			)->
			expAnd(
				Expression::eqId("offerType", $this->offerType)
			);


		if ($type = $form->getValue('city')) {
			$model->set('city', $type);
			$logic->expAnd(
				Expression::eqId('city', $type)
			);
		}

		if ($type = $form->getValue('realtyType')) {
			$model->set('realtyType', $type);
			$logic->expAnd(
				Expression::eqId('realtyType', $type)
			);
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
			$projection->add(	// Remove me in case of neighbores search
				Projection::having(
					Expression::eq(
						SQLFunction::create('count', 'features.id'),
						$filterNumber
					)
				)
			);
		}
		
		$page = $form->getActualValue('page');
		$total = Criteria::create(Realty::dao())->
			setProjection(
				Projection::count('id', 'count')
			)->
			add($logic)->
			getCustom('count');
		
		$criteria = Criteria::create(Realty::dao())->
			setProjection($projection)->
			add($logic)->
			setLimit($this->limits[$this->listVariant])->
			addOrder(
				OrderBy::create(DBField::create('relevance'))->desc()
			)->
			setOffset(
				($page - 1) * $this->limits[$this->listVariant]
			);
//		echo '<br/><br/><br/>'.$criteria->toString();
//		exit;
		
		$relevance = ArrayHelper::toKeyValueArray(
			$criteria->getCustomList(), 'id', 'relevance'
		);

		$list = array();

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
