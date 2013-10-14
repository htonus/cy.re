<?php

	final class ServiceHelper
	{
		const RATES = 'currency_rates';
		
		public function __construct()
		{
			$this->base		= PATH_WEB;
		}

		/**
		 * @return ServiceHelper
		 */
		public static function create()
		{
			return new self;
		}

		/**
		 * Gets from cache or fetches form Eurobank currency rates with base Euro
		 * @return array $rates
		 */
		public function getCurrencyRates()
		{
			$supported = array('EUR', 'USD', 'RUB', 'GBP', 'CNY');
//			SocketMemcached::create()->mark(DOMAIN)->delete(self::RATES);
			
			if (!($rates = SocketMemcached::create()->mark(DOMAIN)->get(self::RATES))) {
				GlobalVar::me()->import('CurrencyFetcher');

				$rates = array_merge(
					array('EUR' => 1),
					CurrencyFetcher::create()->getRates()
				);
				
				$rates = array_intersect_key($rates, array_flip($supported));
				SocketMemcached::create()->mark(DOMAIN)->set(self::RATES, $rates);
			}

			return $rates;
		}
	}
