<?php

/******************************************************************************
 *   Copyright (C) 2012 by Mikhail Cherviakov                                 *
 *   email: htonus@gmail.com                                                  *
 ******************************************************************************/
/* $Id$ */

/**
 * Description of Currency
 *
 * @author htonus
 */

final class CurrencyFetcher
{
	const SOURCE = 'http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml';

	public static function create()
	{
		return new self;
	}
	
	public function getRates()
	{
		$xml = file_get_contents(self::SOURCE);
		$rates = array();

		if (preg_match_all("/currency='([^']+)' rate='([^']+)'/", $xml, $m)) {
			$rates = array_combine($m[1], $m[2]);
		}

		return $rates;
	}
}
