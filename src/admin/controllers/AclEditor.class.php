<?php
/******************************************************************************
 *   Copyright (C) 2012 by Mikhail Cherviakov                                 *
 *   email: htonus@gmail.com                                                  *
 ******************************************************************************/
/* $Id$ */


/**
 * Access control management controller
 *
 * @author htonus
 */
class AclEditor extends PrototypedEditor
{
	private $accessMapping = array();
	
	public function __construct($subject)
	{
		parent::__construct($subject);

		$this->setAccessMappingList(
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
		}
		
		return $mav;
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
	
	protected function setAccessMappingList($first, $second = null)
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
