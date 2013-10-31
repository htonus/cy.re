<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of buy Controller
 *
 * @author htonus
 */
class controllerAbout extends controllerArticle
{
        public function __construct()
        {
                $this->type = ArticleType::about();
                $this->section = Section::about();
                
                parent::__construct();
        }
	
	public function actionIndex(HttpRequest $request)
	{
		$items = Criteria::create(Article::dao())->
			add(
				Expression::eqId('type', $this->type)
			)->
			add(
				Expression::notNull('published')
			)->
			setLimit(1)->
			getList();
		
		$mav = ModelAndView::create();
		
		if (count($items)) {
			$mav->getModel()->
				set('article', reset($items))->
				set('action', 'item');
				
		} else {
			$mav->setView(
				RedirectView::create('http://www.esperiaestates.com/htdocs/colb-aboutus.asp')
			);
		}
		
		return $mav;
	}
	
	/*
	public function handleRequest(HttpRequest $request)
	{
		return ModelAndView::create()->
			setView(
				RedirectView::create('http://www.esperiaestates.com/htdocs/colb-aboutus.asp')
			);
	}
	*/
}
