<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-03-15 13:13:00                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	abstract class AutoResourceDAO extends StorableDAO
	{
		public function getTable()
		{
			return 'resource';
		}
		
		public function getObjectName()
		{
			return 'Resource';
		}
		
		public function getSequence()
		{
			return 'resource_id';
		}
	}
?>