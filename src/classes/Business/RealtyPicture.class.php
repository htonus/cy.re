<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.0.10.99 at 2013-04-08 14:21:14                     *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	class RealtyPicture extends AutoRealtyPicture implements Prototyped, DAOConnected
	{
		/**
		 * @return RealtyPicture
		**/
		public static function create()
		{
			return new self;
		}
		
		/**
		 * @return RealtyPictureDAO
		**/
		public static function dao()
		{
			return Singleton::getInstance('RealtyPictureDAO');
		}
		
		/**
		 * @return ProtoRealtyPicture
		**/
		public static function proto()
		{
			return Singleton::getInstance('ProtoRealtyPicture');
		}
		
		// your brilliant stuff goes here
	}
?>