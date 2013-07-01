<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of buy Controller
 *
 * @author htonus
 */
class controllerAbout implements Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->offerType = OfferType::buy();
		$this->section = Section::buy();
	}

	public function handleRequest(\HttpRequest $request)
	{
		return ModelAndView::create()->
			setView(
				RedirectView::create('/')
			);
	}
}
