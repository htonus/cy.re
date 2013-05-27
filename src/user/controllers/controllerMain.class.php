<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of main
 *
 * @author htonus
 */
class controllerMain extends MethodMappedController
{
	const COOKIE_EXPIRE	= '1 year';

	protected $sectionId = null;
	protected $offerType = null;

	public function __construct()
	{
		$this->
			setMethodMappingList(
				array(
					'index'		=> 'actionIndex',
					'error'		=> 'actionError',
				)
			)->
			setDefaultAction('index');
	}

	public function handleRequest(HttpRequest $request)
	{
		$mav = parent::handleRequest($request);

		$request->setAttachedVar('layout', 'default');

		if (!$mav->viewIsRedirect())
			$this->attachCollections($request, $mav);
		
		return $mav;
	}
	
	public function actionIndex(HttpRequest $request)
	{
		$model = Model::create();
		
		$mav = ModelAndView::create()->
			setModel($model);

		$carousel = $this->getBlockList(CustomType::carousel());
		$recent = $this->getBlockList(CustomType::recent(), 4);
		
		$model->
			set(
				'blocks',
				array(
					CustomType::CAROUSEL		=> $carousel,
					CustomType::RECENT		=> $recent
				)
			);
		
		return $mav;
	}

	private function getBlockList(CustomType $type, $amount = null)
	{
		$list = Criteria::create(CustomItem::dao())->
			add(
				Expression::andBlock(
					Expression::eqId('parent.type', $type),
					Expression::eq('parent.section', $this->sectionId)
				)
			)->
			getList();

		$result = array();
		foreach ($list as $item)
			$result[$item->getRealty()->getId()] = $item->getRealty();
		
		if (
			!empty($amount)
			&& count($result) < $amount
		) {
			$list = Criteria::create(Realty::dao())->
				add(
					Expression::andBlock(
						Expression::eqId('realtyType', $this->offerType),
//						Expression::notIn('id', array_keys($recent)),
						Expression::notNull('preview'),
						Expression::notNull('published')
					)
				)->
				addOrder(
					OrderBy::create('created')->desc()
				)->
				setLimit($amount - count($result))->
				getList();
			
			foreach ($list as $item)
				$result[$item->getId()] = $item;
		}
		
		return $result;
	}

	public function actionError(HttpRequest $request)
	{
		if ($request->hasSessionVar('flash.error')) {
			$error = $request->getSessionVar('flash.error');
			Session::drop('flash.error');
		} else {
			$error = 'Unknown error occured. Contact support.';
		}

		return ModelAndView::create()->
			setModel(
				Model::create()->set('error', $error)
			);
	}
	
	protected function attachCollections(HttpRequest $request, ModelAndView $mav)
	{
		$mav->getModel()->
			set(
				'cityList',
				CriteriaUtils::getList(City::dao(), 'i18n.name')
			)->
			set(
				'realtyTypeList',
				CriteriaUtils::getList(RealtyType::dao(), 'i18n.name')
			);
		
		return $this;
	}
}
