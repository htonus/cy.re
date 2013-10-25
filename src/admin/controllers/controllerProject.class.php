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
class controllerProject extends controllerArticle
{
	public function __construct()
	{
		$this->type = ArticleType::project();
		
		parent::__construct();
	}
}
