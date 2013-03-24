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
final class filterUserSession extends RequestFilter
{
	const COOKIE_NAME	= 'autoLogin';
	const COOKIE_EXPIRE	= '1 year';
	
	public function handleRequest(HttpRequest $request)
	{
		if (
			($user = Session::get('user'))
			|| ($user = $this->doLogin($request))
			|| ($user = $this->doAutoLogin($request))
		) {
			$request->setAttachedVar('user', $user);
		}

		if ($request->hasGetVar('signout')) {
			$this->doLogout($request);
			
			return ModelAndView::create()->setView(
				RedirectView::create('/?area=main&action=login')
			);
		}
		
		$request->setAttachedVar('user', $user);

		$mav = $this->controller->handleRequest($request);
		
		if (!$mav->viewIsRedirect())
			$mav->getModel()->
				set('user', $request->getAttachedVar('user'));
		
		return $mav;
	}
	
	private function doLogin(HttpRequest $request)
	{
		$form = Form::create()->
			add(
				Primitive::string('username')->
					addImportFilter(Filter::trim())
			)->
			add(
				Primitive::string('password')->
					addImportFilter(Filter::trim())->
					addImportFilter(Filter::hash())
			)->
			add(
				Primitive::boolean('autoLogin')->
					setDefault(false)
			)->
			import($request->getPost())->
			importMore($request->getCookie());
		
		$user = null;
		
		if ($hash = $form->getValue('password')) {
			$user = Person::dao()->login($form->getValue('username'), $hash);
			
			if ($user) {
				Session::assign('user', $user);
				
				if ($form->getValue('autoLogin')) {
					$cookie = strtoupper(sha1(serialize($user).md5(microtime(true))));
					$user = $user->dao()->save($user->setAutoLogin($cookie));
					$this->setAutoLoginCookie($cookie);
				}

				$url = $request->hasAttachedVar('query')
					? $request->getAttachedVar('query')
					: '/?area=main';

				if (Session::get('backUrl')) {
					$backUrl = Session::get('backUrl');
					Session::drop('backUrl');
				}
				
				$request->setAttachedVar('redirect', PATH_WEB.$backUrl);
			} else {
				$request->setAttachedVar('redirect', PATH_WEB.'user/error');
				Session::assign('backUrl', $request->getAttachedVar('query'));
			}
		}
	
		return $user;
	}
	
	private function doAutoLogin(HttpRequest $request)
	{
		$form = Form::create()->
			add(
				Primitive::string(self::COOKIE_NAME)->
					addImportFilter(Filter::trim())
			)->
			import($request->getCookie());
		
		$user = null;
		
		if ($code = $form->getValue(self::COOKIE_NAME))
			$user = User::dao()->autoLogin($code);
	
		return $user;
	}
	
	private function doLogout(HttpRequest $request)
	{
		Session::drop('user');
		$this->setAutoLoginCookie(null, Timestamp::makeNow()->spawn('-1 hour'));
		
		return $this;
	}
	
	private function setAutoLoginCookie($value = null, Timestamp $age = null)
	{
		if (!$age)
			$age = Timestamp::makeNow()->spawn(self::COOKIE_EXPIRE);
		
		Cookie::create(self::COOKIE_NAME)->
			setDomain(COOKIE_DOMAIN)->
			setPath('/')->
			setValue($value)->
			setMaxAge($age->toStamp())->
			httpSet();
		
		return $this;
	}
}
