<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_api_utility_traits.php
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
	function _F_copy($v___)
	{
		if (\is_resource($v___) || !\is_object($v___)) {
			return $v___;
		}
		if (\is_array($v___)) {
			$a = [];
			foreach ($v___ as $k => $v) {
				$a[$k] = $this->_F_copy($v);
			}
			return $a;
		}
		return clone $v___;
	}

	trait _T_deep_copy
	{
		function __clone() {
			foreach($this as $k => $v) {
				$this->{$k} = _F_copy($v);
			}
		}
	}

	trait _T_multi_construct
	{
		function _F_ctor_call(&$argc___, &$argv___)
		{
			$rc = new \ReflectionClass($this);
			$cls = $rc->getShortName();
			unset($rc); 
			if (@\count($argv___[0]) === 2 && (
					$argv___[0][0] instanceof \std\basic_iterator &&
					$argv___[0][1] instanceof \std\basic_iterator
			)) {
				$ctor = $cls . "_2";
				if (@\method_exists($this, $ctor)) {
					$this->{$ctor}($argv___[0][0], $argv___[0][1]);
					return true;
				}
			} else {
				$ctor = $cls . "_" . $argc___;
				if (@\method_exists($this, $ctor)) {
					if (@\count($argv___[0]) === 1 && \is_array($argv___[0][0])) {
						$this->{$ctor}(...$argv___[0]);
						return true;
					}
					$this->{$ctor}(...$argv___);
					return true;
				}
				return false;
			}
			return false;
		}

		function _F_multi_construct($argc___, $argv___)
		{
			if ($argc___ > 0) {
				if (!$this->_F_ctor_call($argc___, $argv___)) {
					_F_throw_error("No matching constructor");
				}
			}
		}
	}
} /* EONS */
/* EOF */