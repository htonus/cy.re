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
				'get_pictures'		=> 'doGetPictures',
				'add_pictures'		=> 'doAddPictures',
				'drop_picture'		=> 'doDropPicture',
				'preview_picture'	=> 'doPreviewPicture',
				'numbering'			=> 'doNumbering',
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
		$mav->getModel()->set('subject', $form->getValue('id'));
		
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
					$actionUrl = '/?area='.$request->getAttachedVar('area')
						.'&id='.$picture->getId().'&action=';
					
					$item = array(
						'delete_type'	=> 'GET', // 'DELETE'
						'delete_url'	=> $actionUrl.'drop_picture',
						'name'			=> $picture->getName(),
						'text'			=> $picture->getText(),
						'size'			=> $picture->getSize(),
						'thumbnail_url'	=> PictureSize::thumbnail()->getUrl($picture),
						'type'			=> $picture->getType()->getMimeType(),
						'url'			=> PictureSize::normal()->getUrl($picture),
						'id'			=> $picture->getId(),
						'order'			=> $picture->getOrder(),
						'id'			=> $picture->getId(),
						'object'		=> get_class($this->pictureObject),
						'text'			=> $picture->getText()
							? i18nHelper::detokenize($picture->getText())
							: $picture->getName()
					);

					if (
						$this->subject instanceof PreviewPictured
						&& $object->getPreviewId() != $picture->getId()
					)
						$item['preview_url'] =  $actionUrl.'preview_picture';
					
					$response[] = $item;
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
			$actionUrl = '/?area='.$request->getAttachedVar('area')
				.'&id='.$picture->getId().'&action=';
			
			$item = array(
				'delete_type'	=> 'GET', // 'DELETE'
				'delete_url'	=> $actionUrl.'drop_picture',
				'name'			=> $picture->getName(),
				'text'			=> $picture->getText(),
				'size'			=> $picture->getSize(),
				'thumbnail_url'	=> PictureSize::thumbnail()->getUrl($picture),
				'type'			=> $picture->getType()->getMimeType(),
				'url'			=> PictureSize::normal()->getUrl($picture),
				'id'			=> $picture->getId(),
				'order'			=> $picture->getOrder(),
				'id'			=> $picture->getId(),
				'object'		=> get_class($this->pictureObject),
				'text'			=> $picture->getText()
					? i18nHelper::detokenize('___'.$picture->getText().'___')
					: $picture->getName()
			);

			if (
				$this->subject instanceof PreviewPictured
				&& $form->getValue('id')->getPreviewId() != $picture->getId()
			)
				$item['preview_url'] =  $actionUrl.'preview_picture';
			
			$response[] = $item;
		}
		
		$mav->getModel()->
			set('subject', $form->getValue('id'))->
			set('data', array('files' => $response));
		
		return $mav;
	}
	
	protected function doDropPicture(HttpRequest $request)
	{
		$request->setAttachedVar('layout', 'json');
		$mav = ModelAndView::create();
		$result = false;

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
				$mav->getModel()->set('subject', $object);
				$picture->dao()->dropById($picture->getId());
				$object->getPictures()->fetch();
				$result = true;
			} catch (Exception $e) {
				$data['error'] = $e->getMessage();
			}
		}
		
		$mav->getModel()->set('data', array('success' => $result));
		
		return $mav;
	}

	protected function doPreviewPicture(HttpRequest $request)
	{
		$request->setAttachedVar('layout', 'json');
		$mav = ModelAndView::create();
		$result = false;
		
		$form = Form::create()->
			add(
				Primitive::integerIdentifier('id')->
				of(get_class($this->pictureObject))->
				required()
			)->
			import($request->getGet());

		if (!$form->getErrors()) {
			try {
				$picture = $form->getValue('id');
				$object = $picture->getObject();
				$mav->getModel()->set('subject', $object);
				
				$object->dao()->save(
					$object->setPreview($picture)
				);
				
				$result = true;
			} catch (Exception $e) {/*_*/}
		}
		
		$mav->getModel()->set('data', array('success' => $result));

		return $mav;
	}

	protected function doAddTextToPicture(HttpRequest $request)
	{
		
	}

	protected function doNumbering(HttpRequest $request)
	{
		$numbers = Form::create()->
			add(
				Primitive::set('numbers')
			)->
			import($request->getGet())->
			importMore($request->getPost())->
			getValue('numbers');
		
		$return = 0;
		
		try {
			if ($numbers) {
				$db = DBPool::me()->getLink();
				
				foreach ($numbers as $id => $order) {
					$result = $db->queryRaw('update "'.RealtyPicture::dao()->getTable().'" set "order"='.$order.' where "id"='.$id);
					RealtyPicture::dao()->uncacheById($id);
				}

				RealtyPicture::dao()->uncacheLists();

				$return = 1;
			}
		} catch (Exception $e) {/*_*/}
			
		return $this->sendJson(array('result' => $return));
	}
}
