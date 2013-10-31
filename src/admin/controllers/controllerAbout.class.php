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
class controllerAbout extends controllerArticle
{
	public function __construct()
	{
		$this->type		= ArticleType::about();
		
		parent::__construct();
	}
}
