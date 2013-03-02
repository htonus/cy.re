<?php
/******************************************************************************
 *   Copyright (C) 2012 by Mikhail Cherviakov                                 *
 *   email: htonus@gmail.com                                                  *
 ******************************************************************************/
/* $Id$ */

/**
 * Description of Application
 *
 * @author htonus
 */
final class Application
{
	private $request = null;
	
	private $allowedAreas = array(
		'main',
		'user',
		'unit',
		'city',
		'featureType',
		'realtyType',
		'property',
		'language',
	);
		
	public function __construct(HttpRequest $request)
	{
		$this->request = $request;
	}

	public static function create(HttpRequest $request)
	{
		return new self($request);
	}
	
	public function run()
	{
		$lang = Language::dao()->getByCode('en');
		GlobalVar::me()->set('language', $lang);
		
		$area = $this->getArea();
		$controller = 'controller'.ucfirst($area);
		
		switch ($area) {
			default:
				$chain = new $controller;
				break;
		}
		
		$this->attachResolver();
		
		$mav = $chain->handleRequest($this->request);
		
		$this->render($mav);
	}
	
	private function getArea()
	{
		$area = Form::create()->
			add(
				Primitive::string('area')->
				addImportFilter(Filter::trim())->
				setDefault(DEFAULT_AREA)
			)->
			import($this->request->getGet())->
			importMore($this->request->getPost())->
			getActualValue('area');
		
		if (!in_array($area, $this->allowedAreas))
			throw new SecurityException('error:404');
		
		$this->request->setAttachedVar('area', $area);
		
		return $area;
	}
	
	private function render(ModelAndView $mav)
	{
		$model = $mav->getModel();
		$view = $mav->getView();
		
		if ($view instanceof RedirectView) {
			return $view->render($model);
		}
		
		$layout = $this->request->hasAttachedVar('layout')
			? $this->request->getAttachedVar('layout')
			: $this->request->getAttachedVar('area');
		
		$model->set('layout', $layout);

		if (empty($view)) {
			$view = $layout;
		}

		if (is_string($view)) {
			$view = $this->request->getAttachedVar('resolver')->
				resolveViewName($view);
		}
		
		if ($view instanceof View) {
			$model->
				set('area', $this->request->getAttachedVar('area'))->
				set('urlMapper', $this->request->getAttachedVar('urlMapper'))->
				set('html', HtmlHelper::create());
			
//			$model->set('action', $request->getAttachedVar('action'));
		} else {
			$view = RedirectView::create(PATH_WEB_ADMIN.'error/404');
		}
		
		$view->render($model);
	}
	
	private function attachResolver()
	{
		$resolver = MultiPrefixPhpViewResolver::create()->
			setViewClassName('SimplePhpView')->
			setPostfix(EXT_TMPL)->
			addPrefix(PATH_TEMPLATES);
		
		$this->request->setAttachedVar('resolver', $resolver);
		$this->request->setAttachedVar('urlMapper', UrlMapper::me()->setLanguage('en'));
		
		return $this;
	}
}
