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
class controllerProject extends controllerArticle
{
	public function __construct()
	{
		$this->type = ArticleType::project();
		$this->section = Section::project();
		
		parent::__construct();
	}
}
