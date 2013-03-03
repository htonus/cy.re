<?php
/******************************************************************************
 *   Copyright (C) 2012 by Mikhail Cherviakov                                 *
 *   email: htonus@gmail.com                                                  *
 ******************************************************************************/
/* $Id$ */


/**
 * User management controller
 *
 * @author htonus
 */
final class controllerRealtyType extends i18nEditor
{
	public function __construct()
	{
		parent::__construct(RealtyType::create());
	}
}
