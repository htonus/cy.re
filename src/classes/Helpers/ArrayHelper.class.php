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
			
			$treeIndexes = self::buildPlainTreeIndexes($pairs, null, true);
			
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
		public static function buildTreeIndexes($items, $parent = null, $reset = false)
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
				$leaves[$child] = self::buildTreeIndexes($items, $child);
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
        public static function buildPlainTreeIndexes($items, $parent = 0, $reset = false)
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
					self::buildPlainTreeIndexes($items, $child)
				);
				
                $leaf[self::ID_PREFIX.$parent][self::ID_RIGHT] = ++ $right;
            }

            $leaves = array_merge($leaves, $leaf);
            $left = $right;

            return $leaves;
		}
		
		/**
		 * Expects collection of NamedObject elements to convert it ID => NAME
		 * @param array $array
		 * @return array $result
		 */
		public static function toNameList(array $array)
		{
			$out = array();
			
			foreach ($array as $item) {
				$out[$item->getId()] = $item->getName();
			}
			
			return $out;;
		}
	}