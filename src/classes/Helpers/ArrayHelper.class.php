<?php

	final class ArrayHelper extends StaticFactory
	{
		const ID_PREFIX	= '_';
		const ID_LEFT	= 0;
		const ID_RIGHT	= 1;
		
		public static function toKeyValueArray(array $array, $key, $value)
		{
			$out = array();

			foreach ($array as $row) {
				$out[$row[$key]] = $row[$value];
			}

			return $out;
		}

		public static function buildTree($items)
		{
			$tree = $pairs = array();

			foreach ($items as $item) {
				$pairs[$item->getId()] = $item->getParentId();
			}

			$treeIndexes = $this->buildPlainTreeIndexes($items, null, true);

			foreach ($items as $item) {
				$item->
					setLeft($treeIndexes[self::ID_PREFIX.$item->getId()][self::ID_LEFT])->
					setRight($treeIndexes[self::ID_PREFIX.$item->getId()][self::ID_RIGHT]);
			}
			
			return $items;
		}

		/**
		 * Builds tree id => array(left, right, array(children))
		 * @staticvar int $left
		 * @staticvar int $right
		 * @param array $items where key - objectId, value - parentId
		 * @param integer $parent parent object id to build sub-branches
		 * @param boolean $reset to reset static vars
		 * @return array $tree
		 */
		function buildTreeIndexes($items, $parent = null, $reset = false)
		{
			static $left = 0, $right = 0;

			if ($reset)
				$left = $right = 0;

			$right = ++ $left + 1;

			$leaves = array(
				self::ID_LEFT => $left,
				self::ID_RIGHT => $right
			);
			
			foreach (array_keys($items, $parent) as $child) {
				$leaves[$child] = $this->buildTreeIndexes($items, $child);
				$leaves[self::ID_RIGHT] = ++ $right;
			}

			$left = $right;

			return $leaves;
		}
		
		/**
		 * Builds plain tree id => array(left, right) with keys ID_PREFIX.ID
		 * @staticvar int $left
		 * @staticvar int $right
		 * @param array $items where key - objectId, value - parentId
		 * @param integer $parent parent object id to build sub-branches
		 * @param boolean $reset to reset static vars
		 * @return array
		 */
        function buildPlainTreeIndexes($items, $parent = null, $reset = false)
        {
            static $left = 0, $right = 0;

            if ($reset)
                $left = $right = 0;

            $right = ++ $left + 1;
            $leaves = array();

            $leaf = array(
				self::ID_PREFIX.$parent => array(
					self::ID_LEFT => $left,
					self::ID_RIGHT => $right
				)
			);

            foreach (array_keys($items, $parent) as $child) {
                $leaves = array_merge(
					$leaves,
					$this->buildPlainTreeIndexes($items, $child)
				);
				
                $leaf[self::ID_PREFIX.$parent][self::ID_RIGHT] = ++ $right;
            }

            $leaves = array_merge($leaves, $leaf);
            $left = $right;

            return $leaves;
		}
	}