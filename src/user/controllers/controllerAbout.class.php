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
class controllerProject extends controllerArticle
{
        public function __construct()
        {
                $this->type = ArticleType::about();
                $this->section = Section::about();
                
                parent::__construct();
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
