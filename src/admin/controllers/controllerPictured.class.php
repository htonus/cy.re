<?php
/******************************************************************************
 *   Copyright (C) 2012 by Mikhail Cherviakov                                 *
 *   email: htonus@gmail.com                                                  *
 ******************************************************************************/
/* $Id$ */


/**
 * Manage pictured objects in order to allow picture actions
 *
 * @author htonus
 */
class controllerPictured extends AclEditor
{
	private $pictureObject = null;
	
	public function __construct($subject)
	{
		parent::__construct($subject);

		if ($subject instanceof Pictured) {
			$this->pictureObject = call_user_func(
				array(get_class($subject).'Picture', 'create')
			);

			$list = array(
				'get_pictures'	=> 'doGetPictures',
				'add_pictures'	=> 'doAddPictures',
				'drop_picture'	=> 'doDropPicture',
			);

			$this->setMethodMappingList($list);
			
			$this->setAccessMappingList($list, Access::UPDATE);
		}
	}
	
	protected function doAddPictures(HttpRequest $request)
	{
		$request->setAttachedVar('layout', 'json');
		
		$form = Form::create()->
			add(
				Primitive::integerIdentifier('id')->
				of(get_class($this->subject))->
				required()
			)->
			add(
				Primitive::set('files')->
				required()
			)->
			import($request->getGet())->
			importMore($request->getPost())->
			importMore($request->getFiles());
		
		$mav = ModelAndView::create();
		
		if (!$form->getErrors()) {
			$object = $form->getValue('id');
			$files = $form->getValue('files');
			$pictures = array();

			$mainObject = $this->pictureObject->
				setObject($object);

			if (is_array($files['name'])) {
				foreach($files['name'] as $key => $name) {
					$tmpObject = clone $mainObject;
					$pictures[] = $tmpObject->
//						setComment($comments[$name])->
//						setMain($main == $name)->
						setName($name)->
						setUploadName($files['tmp_name'][$key]);
				}
			} else {
				$tmpObject = clone $mainObject;
				$pictures[] = $tmpObject->
//					setComment($comments[$files['name']])->
//					setMain($main == $files['name'])->
					setName($files['name'])->
					setUploadName($files['tmp_name']);
			}

			foreach ($pictures as $picture) {
				if ($picture = $this->pictureObject->dao()->add($picture)) {
					$response[] = array(
						'delete_type'	=> 'GET', // 'DELETE'
						'delete_url'	=> '/?area=realty&action=drop_picture&id='.$picture->getId(),
						'name'			=> $picture->getName(),
						'size'			=> $picture->getSize(),
						'thumbnail_url'	=> PictureSize::thumbnail()->getUrl($picture),
						'type'			=> $picture->getType()->getMimeType(),
						'url'			=> $picture->getUrl(),
					);
				}
			}
			
			$mav->getModel()->
				set('data', array('files' => $response));
		}

		return $mav;
	}
	
	protected function doGetPictures(HttpRequest $request)
	{
		$request->setAttachedVar('layout', 'json');
		
		$form = Form::create()->
			add(
				Primitive::integerIdentifier('id')->
				of(get_class($this->subject))
			)->
			import($request->getGet())->
			importMore($request->getPost());
		
		$mav = ModelAndView::create();
		$response = array();
		
		foreach ($form->getValue('id')->getPictures()->getList() as $picture) {
			$response[] = array(
				'delete_type'	=> 'GET', // 'DELETE'
				'delete_url'	=> '/?area='.strtolower(get_class($this->subject)).'&action=drop_picture&id='.$picture->getId(),
				'name'			=> $picture->getName(),
				'size'			=> $picture->getSize(),
				'thumbnail_url'	=> PictureSize::thumbnail()->getUrl($picture),
				'type'			=> $picture->getType()->getMimeType(),
				'url'			=> $picture->getUrl(),
			);
		}
		
		$mav->getModel()->set('data', array('files' => $response));
		
		return $mav;
	}
	
	protected function doDropPicture(HttpRequest $request)
	{
		$request->setAttachedVar('layout', 'json');
		$mav = ModelAndView::create();
		$data = array('success' => false, 'error' => null);
		
		$form = Form::create()->
			add(
				Primitive::integerIdentifier('id')->
				of(get_class($this->pictureObject))->
				required()
			)->
			import($request->getGet());
		
		if (!$form->getErrors()) {
			$picture = $form->getValue('id');
			
			try {
				$object = $picture->getObject();
				$picture->dao()->dropById($picture->getId());
				$object->getPictures()->fetch();
				$data['result'] = true;
			} catch (Exception $e) {
				$data['error'] = $e->getMessage();
			}
		}
		
		$mav->getModel()->set('data', array('success' => $result));
		
		return $mav;
	}
}
