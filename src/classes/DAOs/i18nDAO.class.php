<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-02-24 17:18:46                    *
 *   This file will never be generated again - feel free to edit.            *
 *****************************************************************************/

	abstract class i18nDAO extends Autoi18nDAO
	{
		const I18N = '_i18n';
		
		public function makeSelectHead()
		{
			static $selectHead = array();
			
			if (!isset($selectHead[$className = $this->getObjectName()])) {
				$i18nFields = call_user_func(array($this->getObjectName().self::I18N, 'proto'))->
					getMapping();
				
				$languageField	= $i18nFields['language'];
				$objectField	= $i18nFields['object'];
				
				unset($i18nFields['id']);
				unset($i18nFields['language']);
				unset($i18nFields['object']);
				
				$table = $this->getTable();
				$i18nTable = $table.self::I18N;
				
				$object =
					OSQL::select()->
					from($table)->
					join(
						$i18nTable,
						Expression::andBlock(
							Expression::eq(
								DBField::create(
									$this->getIdName(),
									$table
								),
								DBField::create(
									$objectField,
									$i18nTable
								)
							),
							Expression::eqId(
								DBField::create(
									$languageField,
									$i18nTable
								),
								GlobalVar::me()->get('language')
							)
						)
					);
				
				foreach ($this->getFields() as $field) {
					if (isset($i18nFields[$field]))
						$object->get(new DBField($field, $i18nTable));
					else
						$object->get(new DBField($field, $table));
				}
				
				$selectHead[$className] = $object;
			}
			
			return clone $selectHead[$className];
		}
	}
