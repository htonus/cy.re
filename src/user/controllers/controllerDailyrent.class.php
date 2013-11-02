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
class controllerDailyrent extends controllerList
{
	public function __construct()
	{
		parent::__construct();

		$this->priceType = FeatureType::PRICE_DAYLY;
		$this->section = Section::rent();
	}
}
