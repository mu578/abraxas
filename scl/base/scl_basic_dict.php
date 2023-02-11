<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_basic_dict.php
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
	abstract class basic_dict extends basic_iterable implements 
		  \ArrayAccess
		, \IteratorAggregate
		, \JsonSerializable
		, \Countable
	{
		const container_category = basic_iterable_tag::basic_dict;

		use _T_langarray_container;
		use _T_langarray_string_operator;
		use _T_langarray_debug;
		use _T_langarray_serializable;
		use _T_dict_iterative;
		use _T_dict_iterable;
		use _T_countable;

		function __toArray()
		{ return $this->_M_container; }

		function __toString()
		{
			return get_class($this)
				. " Object"
				. PHP_EOL
				. $this->to_string()
				. PHP_EOL
			;
		}

		function to_array()
		{ return $this->__toArray(); }

		function to_string()
		{
			if ($this->_M_size) {
				return \json_encode(
					  $this->_M_container
					, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES
				);
			}
			return "{}";
		}
	} /* EOC */
} /* EONS */
/* EOF */