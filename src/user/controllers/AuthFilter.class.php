<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Session  filter designed to handle user sessions
 *
 * @author htonus
 */
final class AuthFilter extends RequestFilter
{
	const DEFAULT_USER_NAME	= 'nobody';

	private $noLoginActions = array(
		'main'	=> array('login', 'logout'),
	);
	
	public function handleRequest(HttpRequest $request)
	{
		if ($user = Session::get('user')) {
			// we have user in session
		} elseif ($user = $this->doAutoLogin($request)) {
			// we retrieved user from auto login cookie
		} else {
			// time to create fake user to setup defualt access
			$user = Criteria::create(Person::dao())->
				add(
					Expression::eq('name', self::DEFAULT_USER_NAME)
				)->
				get();

			if (empty($user))
				throw new MissingElementException('There is no defualt User!!!');
		}

		$request->setAttachedVar('user', $user);
		
		$mav = $this->controller->handleRequest($request);
			
		if (!$mav->viewIsRedirect())
			$mav->getModel()->
				set('user', $request->getAttachedVar('user'));

//		} elseif (false) {
//			Session::assign('backUrl', $request->getServerVar('REQUEST_URI'));
//
//			$mav = ModelAndView::create()->
//				setView(RedirectView::create('/?area=main&action=login'));
//		} else {
//			// before I decide what to do with unlogged users
//			$mav = $this->controller->handleRequest($request);
//		}
		
		return $mav;
	}
	
	private function doAutoLogin(HttpRequest $request)
	{
		$form = Form::create()->
			add(
				Primitive::string(Person::COOKIE_NAME)->
					addImportFilter(Filter::trim())
			)->
			import($request->getCookie());
		
		$user = null;
		
		if (
			($code = $form->getValue(Person::COOKIE_NAME))
			&& strlen($code) == 40
		) {
			$user = Criteria::create(Person::dao())->
				add(
					Expression::eq('autologin', $code)
				)->
				get();
			
			Session::assign('user', $user);
		}
		
		return $user;
	}
	
	private function checkAction(HttpRequest $request)
	{
		return !empty($this->noLoginActions[$request->getAttachedVar('area')])
			&& in_array(
				$request->hasAttachedVar('action')
					? $request->getAttachedVar('action')
					: 'index',
				$this->noLoginActions[$request->getAttachedVar('area')]
			);
	}
}
