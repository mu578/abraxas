<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_triad.php
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
	final class triad
	{
		use _T_multi_construct;

		var $first  = null;
		var $second = null;
		var $third  = null;

		function __construct()
		{ $this->_F_multi_construct(func_num_args(), func_get_args()); }

		function triad_1(triad &$triad)
		{
			$this->first = $triad->first;
			$this->second = $triad->second;
			$this->third = $triad->third;
		}

		function triad_2($first, $second, $third)
		{
			$this->first = $first;
			$this->second = $second;
			$this->third = $third;
		}

		function & swap(triad &$triad)
		{
			$first  = $this->first;
			$second = $this->second;
			$third  = $this->third;

			$this->first  = $triad->first;
			$this->second = $triad->second;
			$this->third  = $triad->third;

			$triad->first  = $first;
			$triad->second = $second;
			$triad->third  = $third;

			return $this;
		}
	} /* EOC */
} /* EONS */
/* EOF */