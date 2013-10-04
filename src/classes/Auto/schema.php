<?php
/*****************************************************************************
 *   Copyright (C) 2006-2009, onPHP's MetaConfiguration Builder.             *
 *   Generated by onPHP-1.1.master at 2013-10-04 09:36:36                    *
 *   This file is autogenerated - do not edit.                               *
 *****************************************************************************/

	$schema = new DBSchema();
	
	$schema->
		addTable(
			DBTable::create('language')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(16),
					'name'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(2),
					'code'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(16),
					'native'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BOOLEAN)->
					setNull(false),
					'active'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('token')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(32),
					'name'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('token_i18n')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'object_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'language_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setSize(512),
					'value'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('city')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::NUMERIC)->
					setSize(10)->
					setPrecision(6),
					'latitude'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::NUMERIC)->
					setSize(10)->
					setPrecision(6),
					'longitude'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT),
					'region_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setSize(2),
					'prefix'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('city_i18n')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'object_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'language_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setSize(16),
					'name'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('district')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::NUMERIC)->
					setSize(10)->
					setPrecision(6),
					'latitude'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::NUMERIC)->
					setSize(10)->
					setPrecision(6),
					'longitude'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'city_id'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('district_i18n')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'object_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'language_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setSize(32),
					'name'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('resource')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(16),
					'name'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'type_id'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('group')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(16),
					'name'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setSize(256),
					'text'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('group_access')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'group_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'resource_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::INTEGER)->
					setNull(false),
					'access'
				)->
				setDefault(0)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('person')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(16),
					'name'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setSize(16),
					'surname'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(32),
					'email'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setSize(12),
					'phone'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT),
					'language_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'status_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::TIMESTAMP)->
					setNull(false),
					'created'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(16),
					'username'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(40),
					'password'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setSize(40),
					'autologin'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('unit')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setSize(16),
					'sign'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('unit_i18n')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'object_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'language_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(16),
					'name'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('feature_type')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT),
					'unit_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT),
					'group_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::INTEGER)->
					setNull(false),
					'weight'
				)->
				setDefault(1)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('feature_type_i18n')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'object_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'language_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(16),
					'name'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('realty_type')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setSize(2),
					'prefix'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setSize(256),
					'area_range'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('realty_type_i18n')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'object_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'language_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(16),
					'name'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('feature')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'type_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT),
					'value'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'realty_id'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('realty_picture')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(128),
					'name'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'type_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BOOLEAN),
					'main'
				)->
				setDefault(false)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT),
					'size'
				)->
				setDefault(0)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::INTEGER)->
					setNull(false),
					'width'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::INTEGER)->
					setNull(false),
					'height'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'object_id'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('realty')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::NUMERIC)->
					setSize(10)->
					setPrecision(6),
					'latitude'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::NUMERIC)->
					setSize(10)->
					setPrecision(6),
					'longitude'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'type_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'offer_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT),
					'city_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT),
					'district_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT),
					'preview_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::TIMESTAMP)->
					setNull(false),
					'created'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::TIMESTAMP),
					'published'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('realty_i18n')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'object_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'language_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setSize(128),
					'name'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setSize(4096),
					'text'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('article_picture')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(128),
					'name'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'type_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BOOLEAN),
					'main'
				)->
				setDefault(false)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT),
					'size'
				)->
				setDefault(0)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::INTEGER)->
					setNull(false),
					'width'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::INTEGER)->
					setNull(false),
					'height'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'object_id'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('article_category')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::TIMESTAMP)->
					setNull(false),
					'created'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::TIMESTAMP),
					'published'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT),
					'parent_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setSize(16),
					'slug'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::INTEGER),
					'left'
				)->
				setDefault(0)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::INTEGER),
					'right'
				)->
				setDefault(0)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('article_category_i18n')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'object_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'language_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setSize(64),
					'name'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setSize(256),
					'text'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('article')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::TIMESTAMP)->
					setNull(false),
					'created'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::TIMESTAMP),
					'published'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT),
					'category_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BOOLEAN),
					'promote'
				)->
				setDefault(false)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('article_i18n')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'object_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'language_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setSize(128),
					'name'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setSize(1024),
					'brief'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setSize(4096),
					'text'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('news_picture')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setNull(false)->
					setSize(128),
					'name'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'type_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BOOLEAN),
					'main'
				)->
				setDefault(false)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT),
					'size'
				)->
				setDefault(0)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::INTEGER)->
					setNull(false),
					'width'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::INTEGER)->
					setNull(false),
					'height'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'object_id'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('news')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::TIMESTAMP)->
					setNull(false),
					'created'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::TIMESTAMP),
					'published'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('news_i18n')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'object_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'language_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setSize(128),
					'name'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setSize(4096),
					'text'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('custom_item')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setSize(256),
					'name'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::INTEGER),
					'order'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'parent_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'realty_id'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('custom')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setSize(256),
					'name'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'type_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'section_id'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('static_page')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'type_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT),
					'section_id'
				)
			)
		);
	
	$schema->
		addTable(
			DBTable::create('static_page_i18n')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'id'
				)->
				setPrimaryKey(true)->
				setAutoincrement(true)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'object_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'language_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setSize(128),
					'name'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setSize(526),
					'anons'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::VARCHAR)->
					setSize(4096),
					'text'
				)
			)
		);
	
	// token_i18n.object_id -> token.id
	$schema->
		getTableByName('token_i18n')->
		getColumnByName('object_id')->
		setReference(
			$schema->
				getTableByName('token')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// token_i18n.language_id -> language.id
	$schema->
		getTableByName('token_i18n')->
		getColumnByName('language_id')->
		setReference(
			$schema->
				getTableByName('language')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// city_i18n.object_id -> city.id
	$schema->
		getTableByName('city_i18n')->
		getColumnByName('object_id')->
		setReference(
			$schema->
				getTableByName('city')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// city_i18n.language_id -> language.id
	$schema->
		getTableByName('city_i18n')->
		getColumnByName('language_id')->
		setReference(
			$schema->
				getTableByName('language')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// district_i18n.object_id -> district.id
	$schema->
		getTableByName('district_i18n')->
		getColumnByName('object_id')->
		setReference(
			$schema->
				getTableByName('district')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// district_i18n.language_id -> language.id
	$schema->
		getTableByName('district_i18n')->
		getColumnByName('language_id')->
		setReference(
			$schema->
				getTableByName('language')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// group_access.group_id -> group.id
	$schema->
		getTableByName('group_access')->
		getColumnByName('group_id')->
		setReference(
			$schema->
				getTableByName('group')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// group_access.resource_id -> resource.id
	$schema->
		getTableByName('group_access')->
		getColumnByName('resource_id')->
		setReference(
			$schema->
				getTableByName('resource')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// person.language_id -> language.id
	$schema->
		getTableByName('person')->
		getColumnByName('language_id')->
		setReference(
			$schema->
				getTableByName('language')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	$schema->
		addTable(
			DBTable::create('person_group')->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'group_id'
				)
			)->
			addColumn(
				DBColumn::create(
					DataType::create(DataType::BIGINT)->
					setNull(false),
					'person_id'
				)
			)->
			addUniques('group_id', 'person_id')
		);
	
	// unit_i18n.object_id -> unit.id
	$schema->
		getTableByName('unit_i18n')->
		getColumnByName('object_id')->
		setReference(
			$schema->
				getTableByName('unit')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// unit_i18n.language_id -> language.id
	$schema->
		getTableByName('unit_i18n')->
		getColumnByName('language_id')->
		setReference(
			$schema->
				getTableByName('language')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// feature_type_i18n.object_id -> feature_type.id
	$schema->
		getTableByName('feature_type_i18n')->
		getColumnByName('object_id')->
		setReference(
			$schema->
				getTableByName('feature_type')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// feature_type_i18n.language_id -> language.id
	$schema->
		getTableByName('feature_type_i18n')->
		getColumnByName('language_id')->
		setReference(
			$schema->
				getTableByName('language')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// realty_type_i18n.object_id -> realty_type.id
	$schema->
		getTableByName('realty_type_i18n')->
		getColumnByName('object_id')->
		setReference(
			$schema->
				getTableByName('realty_type')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// realty_type_i18n.language_id -> language.id
	$schema->
		getTableByName('realty_type_i18n')->
		getColumnByName('language_id')->
		setReference(
			$schema->
				getTableByName('language')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// feature.type_id -> feature_type.id
	$schema->
		getTableByName('feature')->
		getColumnByName('type_id')->
		setReference(
			$schema->
				getTableByName('feature_type')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// feature.realty_id -> realty.id
	$schema->
		getTableByName('feature')->
		getColumnByName('realty_id')->
		setReference(
			$schema->
				getTableByName('realty')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// realty_i18n.object_id -> realty.id
	$schema->
		getTableByName('realty_i18n')->
		getColumnByName('object_id')->
		setReference(
			$schema->
				getTableByName('realty')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// realty_i18n.language_id -> language.id
	$schema->
		getTableByName('realty_i18n')->
		getColumnByName('language_id')->
		setReference(
			$schema->
				getTableByName('language')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// article_category_i18n.object_id -> article_category.id
	$schema->
		getTableByName('article_category_i18n')->
		getColumnByName('object_id')->
		setReference(
			$schema->
				getTableByName('article_category')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// article_category_i18n.language_id -> language.id
	$schema->
		getTableByName('article_category_i18n')->
		getColumnByName('language_id')->
		setReference(
			$schema->
				getTableByName('language')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// article_i18n.object_id -> article.id
	$schema->
		getTableByName('article_i18n')->
		getColumnByName('object_id')->
		setReference(
			$schema->
				getTableByName('article')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// article_i18n.language_id -> language.id
	$schema->
		getTableByName('article_i18n')->
		getColumnByName('language_id')->
		setReference(
			$schema->
				getTableByName('language')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// news_i18n.object_id -> news.id
	$schema->
		getTableByName('news_i18n')->
		getColumnByName('object_id')->
		setReference(
			$schema->
				getTableByName('news')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// news_i18n.language_id -> language.id
	$schema->
		getTableByName('news_i18n')->
		getColumnByName('language_id')->
		setReference(
			$schema->
				getTableByName('language')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// custom_item.parent_id -> custom.id
	$schema->
		getTableByName('custom_item')->
		getColumnByName('parent_id')->
		setReference(
			$schema->
				getTableByName('custom')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// custom_item.realty_id -> realty.id
	$schema->
		getTableByName('custom_item')->
		getColumnByName('realty_id')->
		setReference(
			$schema->
				getTableByName('realty')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// static_page_i18n.object_id -> static_page.id
	$schema->
		getTableByName('static_page_i18n')->
		getColumnByName('object_id')->
		setReference(
			$schema->
				getTableByName('static_page')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
	// static_page_i18n.language_id -> language.id
	$schema->
		getTableByName('static_page_i18n')->
		getColumnByName('language_id')->
		setReference(
			$schema->
				getTableByName('language')->
				getColumnByName('id'),
				ForeignChangeAction::restrict(),
				ForeignChangeAction::cascade()
			);
	
?>