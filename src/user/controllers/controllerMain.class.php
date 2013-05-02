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
final class controllerMain extends MethodMappedController
{
	const COOKIE_EXPIRE	= '1 year';
	
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

		return $mav;
	}

	public function actionIndex(HttpRequest $request)
	{
		$model = Model::create();
		
		$mav = ModelAndView::create()->
			setModel($model);
		
		return $mav;
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
}
