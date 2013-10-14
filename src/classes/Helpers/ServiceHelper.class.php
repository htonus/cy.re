<?php

	final class ServiceHelper
	{
		const RATES = 'currency_rates';
		
		public function __construct()
		{
			$this->base		= PATH_WEB;
		}

		public function getCurrencyRates()
		{
			if (!($rates = SocketMemcached::create()->mark(DOMAIN)->get(self::RATES))) {
				GlobalVar::me()->import('CurrencyFetcher');
				$rates = CurrencyFetcher::create()->getRates();
				SocketMemcached::create()->mark(DOMAIN)->set(self::RATES, $rates);
			}

			return $rates;
		}
	}
