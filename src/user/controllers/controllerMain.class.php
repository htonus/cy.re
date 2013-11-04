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
class controllerMain extends AclController
{
	const COOKIE_EXPIRE		= '1 year';

	protected $section		= null;
	protected $priceType	= null;

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
		$request->
			setAttachedVar('layout', 'default')->
			setAttachedVar(
				'categoryList',
				ArrayUtils::convertObjectList(
					Criteria::create(ArticleCategory::dao())->getList()
				)
			);
		
		$mav = parent::handleRequest($request);
		
		if (!$mav->viewIsRedirect())
			$this->attachCollections($request, $mav);
		
		return $mav;
	}
	
	public function actionIndex(HttpRequest $request)
	{
		$model = Model::create();
		
		$mav = ModelAndView::create()->
			setModel($model);
		
		$model->
			set('static', $this->getStaticContent())->
			set('promote', $this->getPromoteArticle())->
			set('latestList', $this->getLatestList())->
			set(
				'blocks',
				array(
					CustomType::CAROUSEL	=> $this->getBlockList(CustomType::carousel()),
					CustomType::RECENT	=> $this->getBlockList(CustomType::recent(), 4),
					CustomType::PROJECTS=> $this->getBlockList(CustomType::projects(), 2),
				)
			);
		
		return $mav;
	}

	protected function getObject(HttpRequest $request, $class)
	{
		return Form::create()->
			add(
				Primitive::identifier('id')->
				of($class)
			)->
			import($request->getGet())->
			getValue('id');
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
			$result[$item->getObject()->getId()] = $item->getObject();
		
		if (
			!empty($amount)
			&& count($result) < $amount
		) {
			if ($type->getId() == CustomType::PROJECTS) {
				$list = Criteria::create(Article::dao())->
					add(
						Expression::andBlock(
							Expression::eqId('type', ArticleType::project()),
							Expression::notNull('preview'),
							Expression::notNull('published')
						)
					)->
					addOrder(
						OrderBy::create('created')->desc()
					)->
					setLimit($amount - count($result))->
					getList();
			} else {
				$list = Criteria::create(Realty::dao())->
					add(
						Expression::andBlock(
							Expression::eq('features.type', $this->priceType),
							Expression::notNull('preview'),
							Expression::notNull('published')
						)
					)->
					addOrder(
						OrderBy::create('created')->desc()
					)->
					setLimit($amount - count($result))->
					getList();
			}

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
				$request->getAttachedVar('categoryList')
			)->
			set(
				'legalList',
				StaticPage::dao()->getList($this->section, StaticType::LEGAL)
			)->
			set(
				'priceType', $this->priceType
			)->
			set(
				'section', $this->section
			);
		
		return $this;
	}

	protected function getPromoteArticle()
	{
		$promote = Criteria::create(Article::dao())->
			add(
				Expression::notNull('published')
			)->
			addOrder(
				OrderChain::create()->
				add(
					OrderBy::create('promote')->desc()
				)->
				add(
					OrderBy::create('created')->desc()
				)
			)->
			setLimit(1)->
			getList();

		return reset($promote);
	}

	protected function getLatestList()
	{
		$list = Criteria::create(Article::dao())->
			add(
				Expression::notNull('published')
			)->
			add(
				Expression::isFalse('promote')
			)->
			add(
				Expression::eqId('type', ArticleType::information())
			)->
			addOrder(
				OrderBy::create('created')->desc()
			)->
			setLimit(3)->
			getList();

		return $list;
	}
}
