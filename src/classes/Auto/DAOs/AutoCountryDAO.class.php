<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-10-17 09:54:28                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoCountryDAO extends i18nDAO
	{
		public function getTable()
		{
			return 'country';
		}
		
		public function getObjectName()
		{
			return 'Country';
		}
		
		public function getSequence()
		{
			return 'country_id';
		}
	}
?>