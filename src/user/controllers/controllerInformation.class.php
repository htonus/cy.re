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
class controllerInformation extends controllerArticle
{
	public function __construct()
	{
		$this->type = ArticleType::information();
		$this->section = Section::info();
		
		parent::__construct();
	}
}
