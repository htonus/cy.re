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
class controllerBuy extends controllerList
{
	public function __construct()
	{
		$this->priceType = FeatureType::PRICE;
		$this->section = Section::buy();
		
		parent::__construct();
	}
}
