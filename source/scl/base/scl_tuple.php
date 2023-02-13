<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_tuple.php
//
// Copyright (C) 2017-2018 mu578. All rights reserved.
//
 
/*!
 * @project    Abraxas (Container Library).
 * @author     mu578 2018.
 * @maintainer mu578 2018.
 *
 * @copyright  (C) mu578. All rights reserved.
 */

declare(strict_types=1);

namespace std
{
	final class tuple extends basic_tuple
	{
		use _T_multi_construct;
		use _T_tuple_utils;

		function __construct()
		{
			parent::__construct();
			$this->_F_multi_construct(func_num_args(), func_get_args());
		}

		function tuple_1(array $list_initializer)
		{
			foreach ($list_initializer as &$val) {
				_F_push_back($this->_M_container, $val);
			}
		}

		function tuple_2(array $list_initializer, bool $concat)
		{
			if ($concat === true) {
				$this->_F_unpackv($list_initializer);
			} else {
				foreach ($list_initializer as &$val) {
					_F_push_back($this->_M_container, $val);
				}
			}
		}

		function & swap(tuple &$tuple)
		{
			$c  = $this->_M_container;
			$sz = $this->_M_size;

			$this->_M_container = $tuple->_M_container;
			$this->_M_size      = $tuple->_M_size;

			$tuple->_M_container = $c;
			$tuple->_M_size      = $sz;

			return $this;
		}
	} /* EOC */
} /* EONS */
/* EOF */