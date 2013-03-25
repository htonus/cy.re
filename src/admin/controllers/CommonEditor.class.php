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
class CommonEditor extends PrototypedEditor
{
	const PER_PAGE = 20;

	private $accessMapping = array();
	
	public function __construct($subject)
	{
		parent::__construct($subject);

		$this->map->addSource('id', RequestType::post());

		$this->setMethodMapping('index', 'doIndex')->
			setDefaultAction('index');
		
		$this->setAccessMapping(
			array(
				'drop'		=> Access::DROP,
				'take'		=> Access::UPDATE,
				'save'		=> Access::UPDATE,
				'edit'		=> Access::READ,
				'add'		=> Access::ADD,
				'index'		=> Access::LISTS,
				'publish'	=> Access::PUBLISH,
			)
		);
	}
	
	public function handleRequest(HttpRequest $request)
	{
		if (!$this->checkAccess($request)) {
			Session::assign(
				'flash.message',
				'You do not have access to the requested object and action. If you consider this an error, please contact support'
			);
			
			$mav = ModelAndView::create()->setView(
				RedirectView::create('/?area=main&action=error')
			);
		} else {
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
		}
		
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
		$model->set('languageList', Language::dao()->getList());
		
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

	/**
	 * Ckecks if the user has access to the resource
	 * @param HttpRequest $request
	 * @return boolean
	 */
	private function checkAccess(HttpRequest $request)
	{
		if (
			$request->hasAttachedVar('user')
			&& ($action = $this->chooseAction($request))
			&& isset($this->accessMapping[$action])
		) {
			$user = $request->getAttachedVar('user');

			return $user->getAcl()->
				check($this->subject, $this->accessMapping[$action]);
		}

		return false;
	}
	
	protected function setAccessMapping($first, $second = null)
	{
		if (!is_array($first))
			$first = array($first => $second);
		
		foreach ($first as $key => $value) {
			$this->accessMapping[$key] = empty($second)
				? $value
				: $second;
		}
		
		return $this;
	}
}
