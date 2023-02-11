<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_pair.php
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
	final class pair
	{
		use _T_multi_construct;

		var $first  = null;
		var $second = null;

		function __construct()
		{ $this->_F_multi_construct(func_num_args(), func_get_args()); }

		function pair_1(pair &$pair)
		{
			$this->first = $pair->first;
			$this->second = $pair->second;
		}

		function pair_2($first, $second)
		{
			$this->first = $first;
			$this->second = $second;
		}

		function & swap(pair &$pair)
		{
			$first  = $this->first;
			$second = $this->second;

			$this->first  = $pair->first;
			$this->second = $pair->second;

			$pair->first  = $first;
			$pair->second = $second;

			return $this;
		}
	} /* EOC */
} /* EONS */
/* EOF */