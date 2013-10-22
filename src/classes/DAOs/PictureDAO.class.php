<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-03-02 10:59:16                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	abstract class PictureDAO extends AutoPictureDAO
	{
		public function add(Identifiable $object)
		{
			if ($tmpName = $object->getUploadName()) {
				$path = $dirName = null;
				
				$db = DBPool::me()->getByDao($this)->begin();
				
				try {
					$info = getimagesize($tmpName);
					
					$object->
						setTypeId($info[2])->
						setWidth($info[0])->
						setHeight($info[1])->
						setSize(filesize($tmpName));
					
					$object = parent::add($object);
					
					$path = $object->getPath();
					$dirName = dirname($path);

					if (!file_exists($dirName)) {
						if (!mkdir($dirName, 0775, true))
							throw new Exception('Can not create destination directory');
					}

					if (
						is_writable($dirName)
						&& move_uploaded_file($tmpName, $object->getPath())
						&& file_exists($object->getPath())
					) {
						chmod($object->getPath(), 0664);
						
						$db->commit();
					} else {
						throw new Exception('Can not store file: '.$path);
					}

				} catch(Exception $e) {
					if (!empty($path) && is_file($path))
						unlink ($path);

					$db->rollback();
				}
			}
			
			return $object;
		}
		
		public function dropById($id)
		{
			$result = null;
			$db = DBPool::getByDao($this)->begin();
			
			try {
				$picture = $this->getById($id);
				$path = $picture->getPath();
				
				$result = parent::dropById($id);
				
				if (file_exists($path))
					if (!unlink ($path))
						throw new Exception('Can not remove picture from the path: '.$path);
				
				@exec('rm -f '.dirname($path).'/cache/'.$id.'.*');
				
				$db->commit();
			} catch (Exception $e) {
				$db->rollback();
				throw $e;
			}
			
			return $result;
		}
	}
