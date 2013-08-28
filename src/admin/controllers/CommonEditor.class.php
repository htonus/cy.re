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
		$this->beforeHandle($request);
		
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
		
		$this->afterHandle($request, $mav);
		
		return $mav;
	}
	
	protected function beforeHandle(HttpRequest $request) {/*_*/}
	
	protected function afterHandle(HttpRequest $request, ModelAndView $mav)
	{
		if (!$mav->viewIsRedirect())
			$this->attachCollections($request, $mav->getModel());
		
		return $this;
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
			FormUtils::object2form($object, $form);

			if (
				$form->getValue('active')
				&& ($error = $this->hasPublishError($object, $form))
			) {
				Session::assign(
					'flash.error',
					'Cannot publish '.$error
				);
			} else {
			
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
		}
		
		return ModelAndView::create()->
			setView(
				RedirectView::create(
					'/index.php?area='.$request->getAttachedVar('area')
					.'&action=edit&id='.$object->getId()
				)
			);
	}

	protected function hasPublishError(Identifiable $object, Form $form)
	{
		return null;
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
			addOrder('id');
		
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

	protected function sortTree(ArticleCategory $left, ArticleCategory $right)
	{
		return
			(
				$left->getLeft() > $right->getLeft()
				&& $left->getRight() < $right->getRight()
			)
			|| $left->getLeft() > $right->getRight()
				? 1
				: -1;
	}
}
