<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of buy Controller
 *
 * @author htonus
 */
class controllerBuy extends controllerMain
{
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
		
		$list = Criteria::create(Realty::dao());
		
		$criteria = $this->getListCriteria($request, $model);
		
		$model->set('realtyList', $criteria->getList());
		
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
		
		$model = Model::create()->set('realty', $realty);
		
		return ModelAndView::create()->
			setModel($model);
	}
	
	protected function attachCollections(HttpRequest $request, ModelAndView $mav)
	{
		return parent::attachCollections($request, $mav);
	}
	
	private function getListCriteria(HttpRequest $request, Model $model)
	{
		$form = Form::create()->
			add(
				Primitive::identifier('realtyType')->
				of('RealtyType')
			)->
			add(
				Primitive::set('f')
			)->
			import($request->getGet());
		
		$criteria = Criteria::create(Realty::dao());
		
		if ($type = $form->getValue('realtyType')) {
			$model->set('realtyType', $type);
			$criteria->add(
				Expression::eqId('realtyType', $type)
			);
		}
		
		$model->set('filter', $form->getValue('f'));
		
		foreach ($form->getValue('f') as $featureId => $value) {
			if (empty($value))
				continue;
			
			if (preg_match('/-/', $value)) {
				$parts = explode('-', $value);
				
				if (!empty($parts[0])) {
					$criteria->add(
						Expression::andBlock(
							Expression::eq('features.id', $featureId),
							Expression::gtEq('features.value', $parts[0])
						)
					);
				}
				
				if (!empty($parts[1])) {
					$criteria->add(
						Expression::andBlock(
							Expression::eq('features.id', $featureId),
							Expression::ltEq('features.value', $parts[1])
						)
					);
				}
			} else {
				$criteria->add(
					Expression::andBlock(
						Expression::eq('features.id', $featureId),
						Expression::eq('features.value', $value)
					)
				);
			}
		}
		
//		echo $criteria->toString();
		
		return $criteria;
	}
}
