<?php
/******************************************************************************
 *   Copyright (C) 2012 by Mikhail Cherviakov                                 *
 *   email: htonus@gmail.com                                                  *
 ******************************************************************************/
/* $Id$ */


/**
 * Articles management controller
 *
 * @author htonus
 */
final class controllerCache extends MethodMappedController
{
	public function __construct()
	{
		$this->setMethodMappingList(array(
			'index'		=> 'doIndex',
			'clean'		=> 'cleanPictureCache',
			'check_db'	=> 'checkDatabaseIntegrity',
			'sync_db'	=> 'fixDatabaseIntegrity',
			'check_fs'	=> 'checkFilesystemIntegrity',
			'sync_fs'	=> 'fixFilesystemIntegrity',
		))->
		setDefaultAction('index');
	}

	public function handleRequest(HttpRequest $request)
	{
		$mav = parent::handleRequest($request);
		
		if (!$request->hasAttachedVar('layout'))
			$request->setAttachedVar('layout', 'default');
		
		return $mav;
	}
	
	protected function doIndex(HttpRequest $request)
	{
		return ModelAndView::create();
	}
	
	protected function cleanPictureCache(HttpRequest $request)
	{
		$result = @exec('rm -Rfv '.PATH_PIX.'cache/* | grep jpeg | wc -l');
		
		if ($result < 1) {
			Session::assign('flash.info', 'nothing to delete');
		} else {
			Session::assign('flash.success', 'Successfuly removed '.$result.' cached pictures');
		}
		
		return ModelAndView::create()->
			setView(
				RedirectView::create('/?area=cache')
			);
	}
	
	protected function checkDatabaseIntegrity(HttpRequest $request, $idsOnly = false)
	{
		$missedIds = array();
		
		$list = Criteria::create(RealtyPicture::dao())->
			addProjection(
				Projection::property('id')
			)->
			addProjection(
				Projection::property('type')
			)->
			getCustomList();
		
		foreach ($list as $row) {
			$id = $row['id'];
			$type = new ImageType($row['type_id']);
			$path = PATH_PIX
				.implode('/', str_split(substr(sprintf('%08d', $id), 0, -2), 2)).'/'
				.$id.'.'.$type->getExtension();
			
			if (!file_exists($path))
				$missedIds[] = $id;
		}
		
		$model = Model::create();
		
		if ($idsOnly) {
			$model->set('missedPictures', $missedIds);
		} else {
			$model->set(
				'missedPictures',
				empty($missedIds)
					? array()
					: Criteria::create(RealtyPicture::dao())->
						add(Expression::in('id', $missedIds))->
						getList()
			);
		}
		
		return ModelAndView::create()->setModel($model);
	}
	
	protected function fixDatabaseIntegrity(HttpRequest $request)
	{
		$mav = $this->checkDatabaseIntegrity($request, true);
		
		if ($ids = $mav->getModel()->get('missedPictures')) {
			try {
				RealtyPicture::dao()->dropByIds($ids);
				Session::assign('flash.success', 'Successfuly removed corrupted data.');
			} catch (DatabaseException $e) {
				Session::assign(
					'flash.error',
					'Error while trying to delete corrupted database fecords.<br/>'
						.$e->getMessage()
				);
			}
		}
		
		return ModelAndView::create()->
			setView(
				RedirectView::create('/?area=cache&action=check_db')
			);
	}
	
	protected function checkFilesystemIntegrity(HttpRequest $request, $idsOnly = false)
	{
		$result = array();
		$this->checkFS(PATH_PIX.'00', $result);
		
		return ModelAndView::create()->
			setModel(
				Model::create()->set('missedPictures', $result)
			);
	}
	
	protected function fixFilesystemIntegrity(HttpRequest $request)
	{
		$result = array();
		$this->checkFS(PATH_PIX.'00', $result);
		$error = false;
		
		if (!empty($result)) {
			foreach ($result as $id) {
				$path = implode('/', str_split(substr(sprintf('%08d', $id), 0, -2), 2))
					.'/'.$id.'.*';
				
				try {
					exec('rm -f '.PATH_PIX.$path);
					exec('rm -f '.PATH_PIX.'cache/'.$path);
				} catch(Exception1 $e) {
					$error = true;
				}
			}
		}
		
		if ($error) {
			Session::assign('flash.error', 'Error while trying to delete corrupted database fecords.');
		} else {
			Session::assign('flash.success', 'Successfuly removed corrupted data.');
		}
		
		return ModelAndView::create()->
			setView(
				RedirectView::create('/?area=cache&action=check_fs')
			);
	}
	
	private function checkFS($path, &$missing)
	{
		$dir = opendir($path);
		
		while ($entry = readdir($dir)) {
			if ($entry == '.' || $entry == '..')
				continue;
			
			if (is_dir($path.'/'.$entry)) {
				$this->checkFS($path.'/'.$entry, $missing);
			} elseif (preg_match('/(\d+)/', $entry, $m)) {
				$result = DBPool::me()->getLink()->queryRaw('select id from realty_picture where id='.$m[1]);
				
				if (!pg_fetch_row($result)) {
					$missing[] = $m[1];
				}
			}
		}
	}
}
