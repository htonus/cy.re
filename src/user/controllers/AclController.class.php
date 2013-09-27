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
class AclController extends MethodMappedController
{
	/**
	 * Object to aplly for Acl rules
	 * @var Identifiable
	 */
	protected $accessObject = null;

	/**
	 * Array of pairs: action => accessType (for the subject)
	 * If no rules - access allowed for everyone ?
	 * @var array
	 */
	protected $accessMap = array();
	
	public function handleRequest(HttpRequest $request)
	{
		$acl = $request->getAttachedVar('user')->getAcl();
		
		if (
			!isset($this->accessMap[$action = $this->chooseAction($request)])
			|| $acl->check($this->accessObject, $this->accessMap[$action])
		) {
			$mav = parent::handleRequest($request);
		} else {
			$mav = ModelAndView::create()->setView(
				RedirectView::create('/')
			);
		}

		return $mav;
	}

	protected function setAccessRules($rules)
	{
		foreach ($rules as $action => $access)
			$this->accessMap[$action] = $access;

		return $this;
	}
}
