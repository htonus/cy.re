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
		$this->priceType = FeatureType::PRICE_MONTHLY;
		$this->section = Section::rent();
		
		parent::__construct();
	}
}
