<?php
/******************************************************************************
 *   Copyright (C) 2012 by Mikhail Cherviakov                                 *
 *   email: htonus@gmail.com                                                  *
 ******************************************************************************/
/* $Id$ */


/**
 * Articles management controller
 *
 * @author htonus
 */
class controllerInformation extends controllerArticle
{
	public function __construct()
	{
		$this->type = ArticleType::information();
		
		parent::__construct();
	}
	
	
	protected function attachCollections(HttpRequest $request, ModelAndView $mav)
	{
		return parent::attachCollections($request, $mav);
	}
}
