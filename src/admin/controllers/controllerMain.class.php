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
final class controllerMain extends MethodMappedController
{
	const COOKIE_EXPIRE	= '1 year';
	
	public function __construct()
	{
		$this->
			setMethodMappingList(
				array(
					'index'		=> 'actionIndex',
					'error'		=> 'actionError',
					'login'		=> 'actionLogin',
					'logout'	=> 'actionLogout',
					'cache'		=> 'cleanPictureCache',
					'check'		=> 'checkPictureIntegrity',
					'clean'		=> 'fixPictureIntegrity'				)
			)->
			setDefaultAction('index');
	}

	public function handleRequest(HttpRequest $request)
	{
		$mav = parent::handleRequest($request);
		
		$request->setAttachedVar('layout', 'default');
		
		return $mav;
	}

	public function actionIndex(HttpRequest $request)
	{
		$model = Model::create();
		
		$mav = ModelAndView::create()->
			setModel($model);
		
		return $mav;
	}

	public function actionError(HttpRequest $request)
	{
		if ($request->hasSessionVar('flash.error')) {
			$error = $request->getSessionVar('flash.error');
			Session::drop('flash.error');
		} else {
			$error = 'Unknown error occured. Contact support.';
		}

		return ModelAndView::create()->
			setModel(
				Model::create()->set('error', $error)
			);
	}
	
	
	protected function actionLogin(HttpRequest $request)
	{
		$mav = ModelAndView::create();
		
		if ($request->hasAttachedVar('user'))
			return $mav->setView(RedirectView::create('/'));

		$form = Form::create()->
			add(
				Primitive::string('username')->
					required()->
					addImportFilter(Filter::trim())
			)->
			add(
				Primitive::string('password')->
					required()->
					addImportFilter(Filter::trim())->
					addImportFilter(Filter::hash())
			)->
			add(
				Primitive::boolean('autologin')->
					setDefault(false)
			)->
			add(
				Primitive::boolean('submit')->
					setDefault(false)
			)->
			import($request->getPost())->
			importMore($request->getCookie());
		
		if (!$form->getErrors()) {
			$user = Criteria::create(Person::dao())->
				add(
					Expression::andBlock(
						Expression::eq('username', $form->getValue('username')),
						Expression::eq('password', $form->getValue('password'))
					)
				)->
				get();
			
			$view = 'login';
			
			if ($user) {
				Session::assign('user', $user);
				
				if ($form->getValue('autologin')) {
					$cookie = strtoupper(sha1(serialize($user).md5(microtime(true))));
					$user = $user->dao()->save($user->setAutologin($cookie));
					$this->setAutoLoginCookie($cookie);
				}
				
				$backUrl = '/	';
				
				if (Session::get('backUrl')) {
					$backUrl = Session::get('backUrl');
					Session::drop('backUrl');
				}
				
				return $mav->setView(RedirectView::create($backUrl));
			}
		} elseif (!$form->getValue('submit')) {
			$form->dropAllErrors ();
		}
		
		$mav->getModel()->set('form', $form);
	
		return $mav;
	}
	
	protected function actionLogout(HttpRequest $request)
	{
		Session::drop('user');
		$this->setAutoLoginCookie(null, Timestamp::makeNow()->spawn('-1 hour'));
		
		return ModelAndView::create()->
			setView(
				RedirectView::create(PATH_WEB_USER.'buy')
			);
	}
	
	private function setAutoLoginCookie($value = null, Timestamp $age = null)
	{
		if (!$age)
			$age = Timestamp::makeNow()->spawn(self::COOKIE_EXPIRE);
		
		Cookie::create(Person::COOKIE_NAME)->
			setDomain(COOKIE_DOMAIN)->
			setPath('/')->
			setValue($value)->
			setMaxAge($age->toStamp())->
			httpSet();
		
		return $this;
	}
}
