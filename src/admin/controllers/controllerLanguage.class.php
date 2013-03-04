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
final class controllerLanguage extends CommonEditor
{
	public function __construct()
	{
		parent::__construct(Language::create());
		
		$this->getForm()->
			drop('active')->
			add(
				Primitive::ternary('active')->
				optional()->
				setDefault(false)
			);
	}
}
