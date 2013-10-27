<?php
/******************************************************************************
 *   Copyright (C) 2012 by Mikhail Cherviakov                                 *
 *   email: htonus@gmail.com                                                  *
 ******************************************************************************/
/* $Id$ */


/**
 * User management controller
 *
 * @author htonus
 */
final class controllerToken extends i18nEditor
{
	const NO_SUCH_OBJECT	= 1;
	
	private $inlineObject = null;
	
	public function __construct()
	{
		parent::__construct(Token::create());
		
		$this->setMethodMapping('inline', 'doInlineEdit');
		$this->setAccessMapping('inline', Access::UPDATE);
		
		foreach (array('name', 'object', 'objectId') as $name) {
			$this->map->addSource($name, RequestType::get());
			$this->map->addSource($name, RequestType::post());
		}
	}
	
	protected function beforeHandle(HttpRequest $request)
	{
		if (
			$request->hasGetVar('object')
			&& $request->hasGetVar('objectId')
		) {
			$this->inlineObject = Criteria::create(
					call_user_func(
						array($request->getGetVar('object'), 'dao')
					)
				)->
				add(
					Expression::eq('id', $request->getGetVar('objectId'))
				)->
				get();
			
			if ($this->inlineObject) {
				$token = Criteria::create($this->subject->dao())->
					add(
						Expression::eq('object', $request->getGetVar('object'))
					)->
					add(
						Expression::eq('objectId', $request->getGetVar('objectId'))
					)->
					get();
				
				if ($token) {
					$request->setGetVar('id', $token->getId());
					$request->setGetVar('name', $token->getName());
				} else {
					$request->setGetVar(
						'name',
						strtoupper($request->getGetVar('object'))
							.$request->getGetVar('objectId')
					);
				}
			} else {
				$this->proceedHandle = false;
				$this->getForm()->markCustom('id', self::NO_SUCH_OBJECT);
			}
		}
		
		return parent::beforeHandle($request);
	}
	
	protected function afterHandle(HttpRequest $request, ModelAndView $mav)
	{
		if (
			$request->hasGetVar('mode')
			&& $request->getGetVar('mode') == 'inline'
		) {
			$result = array(
				'result'	=> ($errors = $this->getForm()->getErrors()) ? 0 : 1,
				'errors'	=> $errors,
				'id'		=> $this->inlineObject->getId(),
				'text'		=> $errors ? null : $this->subject->getValue(),
			);
			
			if ($this->inlineObject) {
				$this->inlineObject->dao()->save(
					$this->inlineObject->setText($this->subject->getName())
				);
			}
			
			$this->sendJson($result);
		}
		
		return parent::afterHandle($request, $mav);
	}

	protected function getListCriteria(HttpRequest $request, Model $model)
	{
		$criteria = parent::getListCriteria($request, $model);
		
		if ($request->hasGetVar('search')) {
			$model->set('search', $search = trim($request->getGetVar('search')));
			
			$criteria->
				setDistinct()->
				add(
					Expression::ilike('name', "%$search%")
				);
			
		}
		
		$criteria->
			dropOrder()->
			addOrder(
				OrderBy::create('name')->asc()
			);
		
		return $criteria;
	}
	
	public function doInlineEdit(HttpRequest $request)
	{
		$form = $this->map->
			import($request)->
			getForm()->
				markGood('id');
		
		$response = array(
			'result'	=> 0,
		);
		
		if ($form->getErrors()) {
			$this->sendJson($response);
		} else {
			$token = Criteria::create($this->subject->dao())->
				add(
					Expression::eq('name', $form->getValue('name'))
				)->
				get();
			
			if ($token) {
				$this->subject = $token;
				FormUtils::object2form($this->subject, $this->getForm());
			} else {
				$this->getForm()->setValue('name', $form->getValue('name'));
			}
		}
		
		$request->setAttachedVar('layout', 'empty');
		
		return ModelAndView::create()->
			setModel(
				Model::create()->
					set('form', $this->getForm())->
					set('subject', $this->subject)
			);
	}
	
	protected function getRedirectMav(HttpRequest $request)
	{
		$mav = parent::getRedirectMav($request);
		
		if (
			$mav->viewIsRedirect()
			&& $request->hasGetVar('search')
		)
			$mav->getModel()->set('search', $request->getGetVar('search'));
		
		return $mav;
	}
}

