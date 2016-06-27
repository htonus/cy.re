<?php
/***************************************************************************
 *   Copyright (C) 2006-2008 by Anton E. Lebedevich                        *
 *                                                                         *
 *   This program is free software; you can redistribute it and/or modify  *
 *   it under the terms of the GNU Lesser General Public License as        *
 *   published by the Free Software Foundation; either version 3 of the    *
 *   License, or (at your option) any later version.                       *
 *                                                                         *
 ***************************************************************************/

	/**
	 * @ingroup Flow
	**/
	class I18nSimplePhpView extends SimplePhpView
	{
		/**
		 * @return SimplePhpView
		**/
		public function toString($model = null)
		{
			try {
				ob_start();

				Assert::isTrue($model === null || $model instanceof Model);

				if ($model)
					extract($model->getList());

				$partViewer = new PartViewer($this->partViewResolver, $model);

				$this->preRender();

				include $this->templatePath;

				$this->postRender();
				
				return i18nHelper::detokenize(ob_get_clean());
				
			} catch (Exception $e) {
				ob_end_clean();
				throw $e;
			}
		}
		
		public function render($model = null)
		{
			echo $this->toString($model);
		}
		
		/**
		 * @return SimplePhpView
		**/
		protected function preRender()
		{
			return $this;
		}
		
		/**
		 * @return SimplePhpView
		**/
		protected function postRender()
		{
			return $this;
		}
	}
?>