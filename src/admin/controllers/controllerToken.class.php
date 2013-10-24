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
final class controllerToken extends i18nEditor
{
	public function __construct()
	{
		parent::__construct(Token::create());
	}
	
	protected function getListCriteria(HttpRequest $request, Model $model)
	{
		$criteria = parent::getListCriteria($request, $model);
		
		if ($request->hasGetVar('search')) {
			$model->set('search', $search = trim($request->getGetVar('search')));
			
			$criteria->
				setDistinct()->
				add(
					Expression::ilike('name', "%$search%")
				);
			
		}
		
		$criteria->
			dropOrder()->
			addOrder(
				OrderBy::create('name')->asc()
			);
		
		return $criteria;
	}
}
