<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_api_exception.php
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
	trait _T_throwable
	{
		function what() { return $this->getMessage(); }
		
		function rethrow() {
			throw new static($this->getMessage());
		}
	}

	class _C_error extends \Error
	{ use _T_throwable; }

	class _C_type_error extends \TypeError
	{ use _T_throwable; }

	class _C_exception extends \Exception
	{ use _T_throwable; }

	class _C_runtime_error extends _C_error
	{ use _T_throwable; }

	class _C_logic_error extends _C_error
	{ use _T_throwable; }

	class _C_overflow_error extends _C_runtime_error
	{ /* NOP */ }

	class _C_underflow_error extends _C_runtime_error
	{ /* NOP */ }

	class _C_invalid_argument extends _C_logic_error
	{ /* NOP */ }

	class _C_domain_error extends _C_logic_error
	{ /* NOP */ }

	class _C_length_error extends _C_logic_error
	{ /* NOP */ }

	class _C_out_of_range extends _C_logic_error
	{ /* NOP */ }

	function _F_throw_error(string $what)
	{ throw new _C_error($what); }

	function _F_throw_type_error(string $what)
	{ throw new _C_type_error($what); }

	function _F_throw_logic_error(string $what)
	{ throw new _C_logic_error($what); }

	function _F_throw_invalid_argument(string $what)
	{ throw new _C_invalid_argument($what); }

	function _F_throw_domain_error(string $what)
	{ throw new _C_domain_error($what); }

	function _F_throw_length_error(string $what)
	{ throw new _C_length_error($what); }

	function _F_throw_out_of_range(string $what)
	{ throw new _C_out_of_range($what); }

	function _F_throw_overflow_error(string $what)
	{ throw new _C_overflow_error($what); }
} /* EONS */
/* EOF */