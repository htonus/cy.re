<?php

	final class HtmlHelper
	{
		public function __construct()
		{
			
		}
		
		public static function create()
		{
			return new self;
		}
		
		public function js($names, $echo = true)
		{
			if (is_string($names))
				$names = array($names);
			
			$out = '';
			foreach ($names as $name) {
				$name .= '.js';
				
				if (file_exists(PATH_JS.$name)) {
					$time = filemtime(PATH_JS.$name);				
				} else {
					continue;
				}
				
				$out .= $this->niceRow('<script type="text/javascript" src="'.$name.'?'.$time.'"></script>');
			}
			
			if ($echo) {
				echo $out;
			} else {
				return $out;
			}
		}
		
		public function css($names, $echo = true)
		{
			if (is_string($names))
				$names = array($names);
			
			$out = '';
			foreach ($names as $name) {
				$name .= '.css';
				
				if (file_exists(PATH_CSS.$name)) {
					$time = filemtime(PATH_CSS.$name);				
				} else {
					continue;
				}
				
				$out .= $this->niceRow('<link rel="stylesheet" type="text/css" href="'.$name.'?'.$time.'" />');
			}
			
			if ($echo) {
				echo $out;
			} else {
				return $out;
			}
		}
		
		public function jsRaw($text, $echo = true)
		{
			$parts = mb_split("\n", trim($text));
			
			$clean = '';
			$gap = 0;
			foreach ($parts as $part) {
				$part = trim($part);
				$length = mb_strlen($part) -1;
				
				if (
					mb_strrpos($part, '}') !== false
					&& $length == mb_strrpos($part, '}')
				)
					$gap --;
				
				if ($gap < 0)
					break;
				
				$clean .= $this->niceRow($part, $gap);
				
				if (
					mb_strrpos($part, '{') !== false
					&& $length == mb_strrpos($part, '{')
				)
					$gap ++;
			}
			
			if ($gap != 0) {
				$clean .= $this->niceRow('/* fixme! */');
			}
			
			$out = 
				$this->niceRow('<script type="text/javascript">', 0)
				.$clean
				.$this->niceRow('</script>', 0);
			
			if ($echo)
				echo $out;
			else
				return $out;
		}
		
		public function jsOnReady($text)
		{
			return $this->jsRaw(
				$this->niceRow('jq(document).ready(function(){')
				.$this->niceRow(addslashes($text))
				.$this->niceRow('});')
			);
		}
		
		public function niceRow($text, $gapSize = 1)
		{
			return str_repeat("\t", $gapSize).$text."\n";
		}
	}
