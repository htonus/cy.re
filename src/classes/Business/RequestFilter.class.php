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
		
		/**
		 * @param HttpRequest $request
		 * @return Requestfilter $object
		 */
		public static function create(Controller $controller)
		{
			return new self($controller);
		}
	}