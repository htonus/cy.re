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
			get('active')->
				setDefault(false);
		
		$this->setMethodMapping('toggle', 'doToggle');
	}
	
	protected function doToggle(HttpRequest $request)
	{
		$form = $this->getForm()->
			importOne('id', $request->getGet());
		
		if ($language = $form->getValue('id')) {
			$language->setActive(!$language->getActive());
			
			$this->subject->dao()->
				save($language);
		}
		
		return ModelAndView::create()->
			setModel(
				Model::create()->
					set('subject', $language ? $language : $this->subject)->
					set('editorResult', PrototypedEditor::COMMAND_SUCCEEDED)->
					set('form', $form)
			);
	}
}
