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
	private $noLoginActions = array(
		'main'	=> array('login', 'logout'),
	);
	
	public function handleRequest(HttpRequest $request)
	{
		if ($this->doLogout($request)) {
			$mav = ModelAndView::create()->
				setView(
					RedirectView::create('/')
				);
		} else {
			if ($request->hasSessionVar('user')) {
				$user = $request->getSessionVar('user');
			} elseif (!($user = $this->doAutoLogin($request))) {
				// time to create fake user to setup default access
				$user = Criteria::create(Person::dao())->
					add(
						Expression::eq('name', Person::DEFAULT_USER_NAME)
					)->
					get();
				
				if ($user)
					Session::assign('user', $user);
			}
			
			if (empty($user))
				throw new MissingElementException('There is no defualt User!!!');

			$request->setAttachedVar('user', $user);

			$mav = $this->controller->handleRequest($request);
		}
		
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

	private function doLogout(HttpRequest $request)
	{
		if ($request->hasGetVar('signout')) {
			Session::destroy();
			setcookie(Person::COOKIE_NAME, 1, strtotime('-1 year'));
			return true;
		}

		return false;
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
