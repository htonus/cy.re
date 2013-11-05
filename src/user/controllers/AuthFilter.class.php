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
		$mav = ModelAndView::create();

		if ($this->doLogout($request)) {
			$mav->setView(
				RedirectView::create('/')
			);
		} elseif ($user = $this->doLogin($request)) {
			Session::assign('user', $user);
			
			$mav->setView(
				RedirectView::create($request->getServerVar('REQUEST_URI'))
			);
		} else {
			if (
				$request->hasSessionVar('user')
				&& !$request->getSessionVar('user')->isFake()
			) {
				$user = $request->getSessionVar('user');
			} else {
				if (!($user = $this->doAutoLogin($request))) {
					// time to create fake user to setup default access
					$user = Criteria::create(Person::dao())->
						add(
							Expression::eq('name', Person::DEFAULT_USER_NAME)
						)->
						get();
				}
			
				if ($user)
					Session::assign('user', $user);
				else
					throw new MissingElementException('There is no defualt User!!!');
			}

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
	
	private function doLogin(HttpRequest $request)
	{
		$form = Form::create()->
			add(
				Primitive::string('username')->
					addImportFilter(Filter::trim())->
					required()
			)->
			add(
				Primitive::string('password')->
					addImportFilter(Filter::trim())->
					addImportFilter(Filter::hash())->
					required()
			)->
			import($request->getPost());

		$user = null;
		
		if (!$form->getErrors()) {
			$user = Criteria::create(Person::dao())->
				add(
					Expression::eq('username', $form->getValue('username'))
				)->
				add(
					Expression::eq('password', $form->getValue('password'))
				)->
				get();

			if (!$user) {
				Session::assign('flash.error', 'Wrong user credentials');
			}
		}
		
		return $user;
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
