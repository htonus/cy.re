<?php
/**
 * Base class for the request filters
 *
 * Does preFilter and post filter actinos
 */
	abstract class RequestFilter implements Controller
	{
		protected $controller = null;

		public function __construct(Controller $controller)
		{
			$this->controller = $controller;
		}
		
		public function handleRequest(HttpRequest $request)
		{
			return $this->controller->handleRequest($request);
		}
	}