<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-04-11 10:39:37                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoPersonDAO extends StorableDAO
	{
		public function getTable()
		{
			return 'person';
		}
		
		public function getObjectName()
		{
			return 'Person';
		}
		
		public function getSequence()
		{
			return 'person_id';
		}
	}
?>