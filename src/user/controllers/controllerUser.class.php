<?php
/**
 * ALL Acl through AclFilter with fake Anonimous User with real Group
 * to describe access level to the objects. REal User should have another Group
 * to manage his profile and additional services
 *
 * @author htonus
 */
class controllerUser extends controllerMain
{
	public function __construct()
	{
		parent::__construct();
		
		$this->
			setMethodMappingList(
				array(
					'add'		=> 'actionAdd',
					'edit'		=> 'actionEdit',
					'profile'	=> 'actionProfile',
				)
			);
	}

	public function handleRequest(HttpRequest $request)
	{
		return parent::handleRequest($request);
	}

	/**
	 * Adds new User
	 * @param HttpRequest $request
	 */
	protected function actionAdd(HttpRequest $request)
	{
		return ModelAndView::create();
	}

	/**
	 * Updates existing user profile data
	 * @param HttpRequest $request
	 */
	protected function actionEdit(HttpRequest $request)
	{
		return ModelAndView::create();
	}

	/**
	 * Shows profile summary of the User
	 * @param HttpRequest $request
	 */
	protected function actionProfile(HttpRequest $request)
	{
		return ModelAndView::create();
	}
}
