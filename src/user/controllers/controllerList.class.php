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
final class controllerList extends controllerMain
{
	const COOKIE_EXPIRE	= '1 year';
	
	public function __construct()
	{
		$this->
			setMethodMappingList(
				array(
					'buy'		=> 'actionBuy',
					'rent'		=> 'actionRent',
				)
			)->
			setDefaultAction('buy');
	}

	public function handleRequest(HttpRequest $request)
	{
		$mav = parent::handleRequest($request);

		$request->setAttachedVar('layout', 'default');

		return $mav;
	}

	public function actionBuy(HttpRequest $request)
	{
		$model = Model::create();

		$filters = $this->getFilters($request);

		$mav = ModelAndView::create()->
			setModel($model);
		
		return $mav;
	}

	/**
	 * Put filter vars into
	 * @param HttpRequest $request
	 * @return type
	 */
	private function getFilters(HttpRequest $request)
	{
		$form = Form::create()->
			add(
				Primitive::set('f')->
				setDefault(array())
			)->import($request->getGet());
		
		return $form->getValue('f');
	}
}
