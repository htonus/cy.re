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
class controllerRent extends controllerList
{
	public function __construct()
	{
		parent::__construct();

		$this->offerType = OfferType::rent();
		$this->section = Section::rent();
	}
}
