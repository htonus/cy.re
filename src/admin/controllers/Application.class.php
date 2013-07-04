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
	const DEFAULT_AREA = 'main';

	private $request = null;

	public function __construct(HttpRequest $request)
	{
		$this->request = $request;
	}

	/**
	 * @param HttpRequest $request
	 * @return Application
	 */
	public static function create(HttpRequest $request)
	{
		return new self($request);
	}
	
	public function run()
	{
		// FIXME do real language set
		$lang = Language::dao()->getByCode(DEFAULT_LANG_CODE);
		GlobalVar::me()->set('language', $lang);
		
		$area = $this->getAreaAndAction();
		$controller = 'controller'.ucfirst($area);
		
		switch ($area) {
			default:
				$chain = new $controller;
				break;
		}
		
		$chain = new AuthFilter($chain);

		$this->attachResolver();
		
		$mav = $chain->handleRequest($this->request);
		
		$this->render($mav);
	}
	
	private function getAreaAndAction()
	{
		$form = Form::create()->
			add(
				Primitive::string('area')->
				addImportFilter(Filter::trim())->
				setDefault(DEFAULT_AREA)
			)->
			add(
				Primitive::string('action')->
				addImportFilter(Filter::trim())->
				setDefault('index')
			)->
			import($this->request->getGet())->
			importMore($this->request->getPost());
		
		$this->request->
			setAttachedVar('area', $form->getActualValue('area'))->
			setAttachedVar('action', $form->getActualValue('action'));
		
		return $form->getActualValue('area');
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
		
		echo i18nHelper::detokenize($view->toString($model));
//		$view->render($model);
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
