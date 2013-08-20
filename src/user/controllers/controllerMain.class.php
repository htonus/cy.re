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
	const COOKIE_EXPIRE		= '1 year';

	protected $section		= null;
	protected $offerType	= null;

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
			set('static', $this->getStaticContent())->
			set(
				'blocks',
				array(
					CustomType::CAROUSEL		=> $carousel,
					CustomType::RECENT		=> $recent
				)
			);
		
		return $mav;
	}

	private function getStaticContent()
	{
		$types = StaticType::about()->getNameList();

		$result = array();

		$list =
			ArrayUtils::convertObjectList(
				Criteria::create(StaticPage::dao())->
				add(Expression::eqId('section', $this->section))->
				getList()
			);

		foreach ($list as $item)
			$result[$item->getTypeId()] = $item;

		$condition = Expression::chain()->
			expAnd(Expression::isNull('section'));

		if (count($list))
			$condition->
				expAnd(Expression::notIn('type', array_keys($result)));

		$list = Criteria::create(StaticPage::dao())->
			add($condition)->
			getList();

		foreach ($list as $item)
			$result[$item->getTypeId()] = $item;

		return $result;
	}

	private function getBlockList(CustomType $type, $amount = null)
	{
		$list = Criteria::create(CustomItem::dao())->
			add(
				Expression::andBlock(
					Expression::eqId('parent.type', $type),
					Expression::eqId('parent.section', $this->section)
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
						Expression::eqId('offerType', $this->offerType),
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
			)->
			set(
				'categoryList',
				CriteriaUtils::getList(ArticleCategory::dao(), 'i18n.name')
			);
		
		return $this;
	}
}
