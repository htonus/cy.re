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
class CommonEditor extends controllerPictured
{
	const PER_PAGE = 20;

	public function __construct($subject)
	{
		parent::__construct($subject);
		
		$this->map->addSource('id', RequestType::post());

		if ($this->subject instanceof Created) {
			$this->subject->setCreated(Timestamp::makeNow());
			$this->getForm()->drop('created');
		}
		
		if ($this->subject instanceof Published) {
			$this->setMethodMapping('publish', 'doPublish');
		}
		
		$this->setMethodMapping('index', 'doIndex')->
			setDefaultAction('index');
	}
	
	public function handleRequest(HttpRequest $request)
	{
		$mav = parent::handleRequest($request);
		$model = $mav->getModel();

		if (!$request->hasAttachedVar('layout'))
			$request->setAttachedVar('layout', 'default');
		
		if (
			$model->has('editorResult')
			&& $model->get('action') != 'edit'
		) {
			if ($model->get('editorResult') == self::COMMAND_SUCCEEDED)
				return $this->getRedirectMav($request);

			$model->set('action', 'edit');
		}

		if (!$mav->viewIsRedirect())
			$this->attachCollections($request, $model);
		
		return $mav;
	}

	public function doIndex(HttpRequest $request)
	{
		$model = Model::create();

		try {
			$criteria = $this->getListCriteria($request, $model);
			
			$request->setAttachedVar('criteria', $criteria);
			
			// paging stuff
			PagerHelper::create($request)->
				setPerPage($this::PER_PAGE)->
				doPage($model);
			
		} catch (ObjectNotFoundException $e) {
			$model->set('list', array());
		}
		
		$model->
			set('subject', $this->subject);

		return ModelAndView::create()->
			setModel($model);
	}

	protected function doPublish(HttpRequest $request)
	{
		$form = $this->getForm()->
			add(
				Primitive::ternary('active')
			)->
			import($request->getGet());

		if ($object = $form->getValue('id')) {
			$object->dao()->save(
				$object->setPublished(
					$form->getValue('active')
						? Timestamp::makeNow()
						: null
				)
			);
			
			Session::assign(
				'flash.success',
				'Successfully '.($form->getValue('active') ? null : 'un').'published'
			);
		}
		
		return ModelAndView::create()->
			setView(
				RedirectView::create(
					'/index.php?area='.$request->getAttachedVar('area')
					.'&action=edit&id='.$object->getId()
				)
			);
	}
	
	/**
	 * Returns base list criteria
	 * @param HttpRequest $request
	 * @param Model $model
	 * @return Criteria $criteria
	 */
	protected function getListCriteria(HttpRequest $request, Model $model)
	{
		$criteria = Criteria::create($this->subject->dao())->
			addOrder('name');
		
		return $criteria;
	}
	
	protected function attachCollections(HttpRequest $request, Model $model)
	{
		return $this;
	}

	protected function getRedirectMav(HttpRequest $request)
	{
		return ModelAndView::create()->setView(
			new RedirectView(
				'/index.php?area='.lcfirst(get_class($this->subject))
			)
		);
	}
}
