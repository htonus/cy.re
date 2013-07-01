<?php

	final class Logger extends Singleton
	{
		const DEBUG		= 1;
		const WARN		= 2;
		const ERROR		= 3;
		const FATAL		= 4;
		const SILENCE	= 5;

		const A_FILE	= 'file';
		const A_EMAIL	= 'email';
		const A_STDOUT	= 'stdout';

		const P_DAY		= 'day';
		const P_WEEK	= 'week';
		const P_MONTH	= 'month';
		const P_YEAR		= 'year';

		const NAME		= 'default';

		const PREFIX	= 're';
		const POSTFIX	= '.log';

		private $names = array(
			self::DEBUG		=> 'DEBUG',
			self::WARN		=> 'WARN',
			self::ERROR		=> 'ERROR',
			self::FATAL		=> 'FATAL',
			self::SILENCE	=> 'SILENCE',
		);

		private $cfg = array();

		/**
		 *
		 * @param array $cfg
		 *  array(
		 *		'buglovers'	=> 'lover1@email.com lover2@email.com'
		 *		'logfolder'	=> /path/to/log/
		 * // Defaults
		 *		'prefix'	=> MODE
		 *		'level'		=> 1...5
		 *		'period'	=> day, week, month, year	// for file only
		 *		'append'	=> file
		 *		'name'	=> array(
		 *			'level'		=> 1...5,
		 *			'append'	=> array(level => file, level => email, level => stdout)
		 *			'period'	=> day, week, month, year
		 *		)
		 *	)
		 */
		public static function me($cfg = array())
		{
			$me = parent::getInstance(__CLASS__);

			if (!empty($cfg))
				$me->setCfg($cfg);
			
			return $me;
		}

		public function setCfg($cfg)
		{
			$this->cfg = $cfg;
			return $this;
		}

		public function getAppenders($level, $name)
		{
			$appenders = $this->cfg[self::NAME]['append'];

			if (!empty($this->cfg[$name]['append']))
				$appenders = $this->cfg[$name]['append'];

			foreach ($appenders as $appendLevel => $append) {
				if ($level < $appendLevel)
					unset($appenders[$appendLevel]);
			}

			return $appenders;
		}

		public function log($level, $name = null, $msg = null)
		{
			if (empty($this->cfg))
				throw new Exception('Set config!');
			
			if (empty($name))
				$name = self::NAME;
			
			if (empty($msg))
				$msg = print_r(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS), true);

			foreach ($this->getAppenders($level, $name) as $appender) {
				$this->{$appender.'Logger'}($level, $name, $msg);
			}
			
			return $this;
		}

		public function debug($name =  null, $msg = null)
		{
			return $this->log(self::DEBUG, $name, $msg);
		}

		public function warn($name =  null, $msg = null)
		{
			return $this->log(self::WARN, $name, $msg);
		}

		public function error($name =  null, $msg = null)
		{
			return $this->log(self::ERROR, $name, $msg);
		}

		public function fatal($name =  null, $msg = null)
		{
			return $this->log(self::FATAL, $name, $msg);
		}
		
		public function fileLogger($level, $name, $msg)
		{
			$cfg = $this->cfg[self::NAME];

			if (!empty($this->cfg[$name]))
				$cfg = array_merge($cfg, $this->cfg[$name]);

			switch ($cfg['period']) {
				case self::P_DAY:	$date = date('Y-m-d'); break;
				case self::P_WEEK:	$date = date('Y-W').'[w]'; break;
				case self::P_MONTH:	$date = date('Y-m').'[m]'; break;
				case self::P_YEAR:	$date = date('Y').'[y]'; break;
			}

			$fileName = $cfg['logfolder']
				.(preg_match('|/$|', $cfg['logfolder']) ? '' : '/')
				.$date.'_'
				.(preg_match('/admin/i', $cfg['prefix']) ? 'admin_' : '')
				."$name.log";

			if (!file_exists($fileName)) {
				touch($fileName);
				chmod($fileName, 0666);
			}
			
			$file = fopen($fileName, 'a+');
			
			if (!is_string($msg))
				$msg = print_r($msg, true);
			
			fwrite($file, date('Y-m-d H.i.s').' ['.$this->names[$level]."] $msg\n");
			fclose($file);
			
			return $this;
		}
	}
