<?php

	final class UrlHelper
	{
		private $base	= null;
		private $area	= null;
		private $action	= null;
		private $filter	= null;
		private $sortway	= null;
		private $sortname	= null;
		private $slagged	= false;
		
		public function __construct(Model $model, $slugged = false)
		{
			$this->base		= PATH_WEB;
			$this->area		= $model->get('area');
			$this->action	= $model->has('action') ? $model->get('action') : null;
			$this->filter	= $model->has('filter') ? $model->get('filter') : array();

			list($this->sortname, $this->sortway) = $model->has('sort')
				? explode(':', $model->get('sort'))
				: array(null, null);
			
			$this->slugged	= $slugged;
		}

		/**
		 *
		 * @param Model $model
		 * @return UrlHelper
		 */
		public static function create(Model $model)
		{
			return new self($model);
		}
		
		public function setBaseUrl($url)
		{
			$this->base = $url;
			return $this;
		}
		
		public function getUrl()
		{
			$url = $this->base.($this->slagged ? $area.'/' : '?area='.$this->area);

			if ($this->action)
				$url .= $this->slagged ? $action.'/' : '&action='.$this->action;

			return $url;
		}

		public function getFilterUrl()
		{
			$query = http_build_query($this->filter);

			if (!empty($query))
				$query = ($this->slagged ? '?' : '&').$query;

			return $this->getUrl().$query;
		}

		public function getSortUrl($name, $way = null)
		{
			return $this->getFilterUrl()
				.'&sort='.$name.':'.$this->getSortWay($name, $way);
		}

		public function getTableHeader(array $columns = array())
		{
			$out = '';

			foreach ($columns as $name => $field) {
				if (!empty($field)) {
					$title = '<a href="'.$this->getSortUrl($field).'">'.$name;

					if ($field == $this->sortname)
						$title .=
							' <i class="icon-chevron-'
							.($this->getSortWay($field) == 'asc' ? 'up' : 'down')
							.'"></i>';

					$title .= '</a>';
				} else {
					$title = $name;
				}

				$out .= '<th>'.$title.'</th>';
			}

			return $out;
		}

		private function getSortWay($name, $way = null)
		{
			if (empty($way)) {
				$way = $this->sortname == $name ? $this->sortway : 'asc';
			}

			if ($this->sortname == $name)
				$way = $way == 'asc' ? 'desc' : 'asc';

			return $way;
		}
	}
