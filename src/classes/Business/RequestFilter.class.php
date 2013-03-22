<?php
/**
 * Base class for the request filters
 *
 * Does preFilter and post filter actinos
 */
	class Requestfilter implements Controller
	{
		private $filterChain = null;

		public function __construct(Controller $chain)
		{
			$this->filterChain = $chain;
		}
		
		/**
		 * 
		 * @param HttpRequest $request
		 * @return Requestfilter $object
		 */
		public static function create(Controller $chain)
		{
			return new self($chain);
		}

		public function handleRequest(\HttpRequest $request)
		{
			if ($this->preFilter($request))
				$mav = $this->filterChain->handleRequest($request);

			return $this->postFilter($request, $mav);
		}

		protected function /* boolean */ preFilter(HttpRequest $request)
		{
			return true;
		}

		protected function /* ModelAndView */ postFilter(HttpRequest $request, ModelAndView $mav)
		{
			return $mav;
		}
	}