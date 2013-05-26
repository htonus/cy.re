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
	const PER_PAGE = 10;

	protected $offerType = null;

	public function __construct()
	{
		parent::__construct();
		
		$this->
			setMethodMappingList(
				array(
					'list'		=> 'actionList',
					'item'		=> 'actionItem',
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
		$realty = Form::create()->
			add(
				Primitive::identifier('id')->
				of('Realty')
			)->
			import($request->getGet())->
			getValue('id');
		
		$model = Model::create()->set('subject', $realty);
		
		return ModelAndView::create()->
			setModel($model);
	}
	
	protected function attachCollections(HttpRequest $request, ModelAndView $mav)
	{
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
				Primitive::set('f')
			);

		$fields = array('realtyType', 'city');

		foreach($fields as $field)
			$form->add(
				Primitive::identifier($field)->
				of(ucfirst($field))
			);

		$form->import($request->getGet());
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
				$andBlock->add(
					Expression::eq('features.value', $value)
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
		
		
		$criteria = Criteria::create(Realty::dao())->
			setProjection($projection)->
			add($logic)->
			setLimit(self::PER_PAGE)->
			addOrder(
				OrderBy::create(DBField::create('relevance'))->desc()
			)->
			setOffset(
				($form->getActualValue('page') - 1) * self::PER_PAGE
			);

//		echo $criteria->toString();
//		exit;
		
		$relevance = ArrayHelper::toKeyValueArray(
			$criteria->getCustomList(), 'id', 'relevance'
		);

		$list = array();

		if (!empty($relevance)) {
			arsort($relevance);

			$logic = Expression::in('id', array_keys($relevance));

			// Need pager here

			$list = ArrayUtils::convertObjectList(Realty::dao()->getListByLogic($logic));
		}

		$model->
			set('relevance', $relevance)->
			set('filter', $filters)->
			set('realtyList', $list)->
			set('page', $form->getActualValue('page'));

		return $this;
	}
}
