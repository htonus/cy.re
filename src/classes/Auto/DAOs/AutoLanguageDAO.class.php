<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-10-17 09:41:14                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoLanguageDAO extends StorableDAO
	{
		public function getTable()
		{
			return 'language';
		}
		
		public function getObjectName()
		{
			return 'Language';
		}
		
		public function getSequence()
		{
			return 'language_id';
		}
		
		public function uncacheLists()
		{
			Person::dao()->uncacheLists();
			
			return parent::uncacheLists();
		}
	}
?>