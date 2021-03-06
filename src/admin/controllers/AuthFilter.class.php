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
		if (
			(
				($user = Session::get('user'))
				|| ($user = $this->doAutoLogin($request))
			)
			&& $user->isAdmin()
		) {
			$request->setAttachedVar('user', $user);
		}
		
		if (
			$this->checkAction($request)
			|| (
				!empty($user)
				&& $user->isAdmin()
			)
		) {
			$mav = $this->controller->handleRequest($request);
			
			if (
				!$mav->viewIsRedirect()
				&& $request->hasAttachedVar('user')
			)
				$mav->getModel()->
					set('user', $request->getAttachedVar('user'));
		} else {
			Session::destroy();
			Session::start();
			
			Session::assign('backUrl', $request->getServerVar('REQUEST_URI'));
			
			$mav = ModelAndView::create()->
				setView(RedirectView::create(
					PATH_WEB_ADMIN.'/?area=main&action=login')
				);
		}
		
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
