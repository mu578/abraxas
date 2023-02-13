<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_quad.php
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
	final class quad
	{
		use _T_multi_construct;

		var $first  = null;
		var $second = null;
		var $third  = null;
		var $fourth = null;

		function __construct()
		{ $this->_F_multi_construct(func_num_args(), func_get_args()); }

		function quad_1(quad &$quad)
		{
			$this->first = $quad->first;
			$this->second = $quad->second;
			$this->third = $quad->third;
			$this->fourth = $quad->fourth;
		}

		function quad_2($first, $second, $third, $fourth)
		{
			$this->first = $first;
			$this->second = $second;
			$this->third = $third;
			$this->fourth = $fourth;
		}

		function & swap(quad &$quad)
		{
			$first  = $this->first;
			$second = $this->second;
			$third  = $this->third;
			$fourth = $this->fourth;

			$this->first  = $quad->first;
			$this->second = $quad->second;
			$this->third  = $quad->third;
			$this->fourth = $quad->fourth;

			$quad->first  = $first;
			$quad->second = $second;
			$quad->third  = $third;
			$quad->fourth = $fourth;

			return $this;
		}
	} /* EOC */
} /* EONS */
/* EOF */