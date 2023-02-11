<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_functional.php
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
	const operator      = '\std\operator';
	const greater       = '\std\greater';
	const less          = '\std\less';
	const multiplies    = '\std\multiplies';
	const divides       = '\std\divides';
	const modulus       = '\std\modulus';
	const negate        = '\std\negate';
	const minus         = '\std\minus';
	const plus          = '\std\plus';
	const equal_to      = '\std\equal_to';
	const greater_equal = '\std\greater_equal';
	const less_equal    = '\std\less_equal';
	const not_equal_to  = '\std\not_equal_to';

	abstract class placeholders
	{
		const _1  = "^std@_0";
		const _2  = "^std@_1";
		const _3  = "^std@_2";
		const _4  = "^std@_3";
		const _5  = "^std@_4";
		const _6  = "^std@_5";
		const _7  = "^std@_6";
		const _8  = "^std@_7";
		const _9  = "^std@_8";
		const _10 = "^std@_9";
		const _11 = "^std@_10";
		const _12 = "^std@_11";
		const _13 = "^std@_12";
		const _14 = "^std@_13";
		const _15 = "^std@_14";
		const _16 = "^std@_15";
		const _17 = "^std@_16";
		const _18 = "^std@_17";
		const _19 = "^std@_18";
		const _20 = "^std@_19";
	} /* EOC */

	abstract class unary_function
	{
		function __invoke($x___)
		{
			_F_throw_logic_error("No match for 'operator()'");
			return null;
		}
	} /* EOC */

	abstract class binary_function
	{
		function __invoke($x___, $y___)
		{
			_F_throw_logic_error("No match for 'operator()'");
			return null;
		}
	} /* EOC */

	final class _C_binder1st extends unary_function
	{
		var $_M_fn  = null;
		var $_M_val = null;

		function __invoke($x___)
		{ return ($this->_M_op)($this->_M_val, $x___); }

		function __construct(callable $f___, $v___)
		{
			$this->_M_op  = $f___;
			$this->_M_val = $v___;
		}
	} /* EOC */

	final class _C_binder2nd extends unary_function
	{
		var $_M_fn  = null;
		var $_M_val = null;

		function __invoke($x___)
		{ return ($this->_M_op)($x___, $this->_M_val); }

		function __construct(callable $f___, $v___)
		{
			$this->_M_op  = $f___;
			$this->_M_val = $v___;
		}
	} /* EOC */

	function operator(string $op___)
	{
		static $_S_operator_tab = null;

		if (\is_null($_S_operator_tab)) {
			$_S_operator_tab = [
				'(*)'   => function($l, $r) { return $l * $r;                           },
				'(/)'   => function($l, $r) { return $l / $r;                           },
				'(%)'   => function($l, $r) { return $l % $r;                           },
				'(+)'   => function($l, $r) { return $l + $r;                           },
				'(-)'   => function($l, $r) { return $l - $r;                           },
				'(.)'   => function($l, $r) { return $l . $r;                           },
				'(<<)'  => function($l, $r) { return $l << $r;                          },
				'(>>)'  => function($l, $r) { return $l >> $r;                          },
				'(<)'   => function($l, $r) { return $l < $r;                           },
				'(<=)'  => function($l, $r) { return $l <= $r;                          },
				'(>)'   => function($l, $r) { return $l > $r;                           },
				'(>=)'  => function($l, $r) { return $l >= $r;                          },
				'(==)'  => function($l, $r) { return $l == $r;                          },
				'(!=)'  => function($l, $r) { return $l != $r;                          },
				'(===)' => function($l, $r) { return $l === $r;                         },
				'(!==)' => function($l, $r) { return $l !== $r;                         },
				'(&)'   => function($l, $r) { return $l & $r;                           },
				'(^)'   => function($l, $r) { return $l ^ $r;                           },
				'(|)'   => function($l, $r) { return $l | $r;                           },
				'(&&)'  => function($l, $r) { return $l && $r;                          },
				'(||)'  => function($l, $r) { return $l || $r;                          },
				'(**)'  => function($l, $r) { return $l ** $r;                          },
				'(<=>)' => function($l, $r) { return $l == $r ? 0 : ($l < $r ? -1 : 1); },
				'(%=%)' => function($l, $r) { return $l instanceof $r;                  },
			
				'([])'  => function & (&$l, $i) { return $l[$i];                        },
				'(=)'   => function & (&$l, $r) { return $l = $r;                       },
				'(@=)'  => function & (&$l, $r) { return $l = _F_copy($r);              },
				'(+=)'  => function & (&$l, $r) { return $l += $r;                      },
				'(-=)'  => function & (&$l, $r) { return $l -= $r;                      },
				'(.=)'  => function & (&$l, $r) { return $l .= $r;                      },
				'(<--)' => function & (&$x) { return --$x;                              },
				'(>--)' => function & (&$x) { return $x--;                              },
				'(<++)' => function & (&$x) { return ++$x;                              },
				'(>++)' => function & (&$x) { return $x++;                              }
			];
		}
		return $_S_operator_tab[$op___];
	}

	function greater($l___, $r___)
	{
		if (is_string($l___) || is_string($r___)) {
			return \strcmp(\strval($l___), \strval($r___)) > 0;
		}
		return $l___ > $r___;
	}
	
	function less($l___, $r___)
	{
		if (is_string($l___) || is_string($r___)) {
			return \strcmp(\strval($l___), \strval($r___)) < 0;
		}
		return $l___ < $r___;
	}

	function multiplies($l___, $r___)
	{ return $l___ * $r___; }

	function divides($l___, $r___)
	{
		if (\is_int($l___) && \is_int($r___)) {
			return \intdiv(\intval($l___), \intval($r___));
		}
		return $l___ / $r___;
	}

	function modulus($l___, $r___)
	{
		if (\is_float($l___) || \is_float($r___)) {
			return \fmod(\floatval($l___), \floatval($r___));
		}
		return $l___ % $r___;
	}

	function negate($x___)
	{ return -($x___); }

	function minus($l___, $r___)
	{ return $l___ - $r___; }

	function plus($l___, $r___)
	{ return $l___ + $r___; }

	function equal_to($l___, $r___)
	{
		if (is_string($l___) || is_string($r___)) {
			return \strcmp(\strval($l___), \strval($r___)) == 0;
		}
		return $l___ == $r___;
	}

	function greater_equal($l___, $r___)
	{
		if (is_string($l___) || is_string($r___)) {
			return \strcmp(\strval($l___), \strval($r___)) >= 0;
		}
		return $l___ >= $r___;
	}

	function less_equal($l___, $r___)
	{
		if (is_string($l___) || is_string($r___)) {
			return \strcmp(\strval($l___), \strval($r___)) <= 0;
		}
		return $l___ <= $r___;
	}

	function not_equal_to($l___, $r___)
	{
		if (is_string($l___) || is_string($r___)) {
			return \strcmp(\strval($l___), \strval($r___)) != 0;
		}
		return $l___ != $r___;
	}

	function logical_cmp($l___, $r___)
	{
		if (is_string($l___) || is_string($r___)) {
			return \strcmp(\strval($l___), \strval($r___));
		}
		if ($l___ < $r___) {
			return comparison_result::ascending;
		}
		if ($l___ > $r___) {
			return comparison_result::descending;
		}
		return comparison_result::same;
	}

	function logical_and($l___, $r___)
	{ return $l___ && $r___; }

	function logical_or($l___, $r___)
	{ return $l___ || $r___; }

	function logical_not($x___)
	{ return !($x___); }

	function logical_likely($x___)
	{ return !!($x___); }

	function & pre_increment(&$x___)
	{ return ++$x___; }

	function & post_increment(&$x___)
	{ return $x___++; }

	function & pre_decrement(&$x___)
	{ return --$x___; }

	function & post_decrement(&$x___)
	{ return $x___--; }

	function bond(string $fn___, $cls___ = null)
	{
		if (\is_null($cls___)) {
			return $fn___;
		}
		return [$cls___, $fn___];
	}

	/*! callable */
	function bind(callable $f___, ...$args___)
	{
		return function () use ($f___, $args___) {
			if (($argc = func_num_args())) {
				if (\preg_grep('/^' . \preg_quote("^std@_", '/') . '/', $args___)) {
					for ($i = 0, $j = 0 ; $i < \count($args___), $j < $argc; ++$i) {
						if ($args___[$i] === "^std@_" . $i) {
							$args___[$i] = func_get_arg($j);
						} else {
							$j++;
						}
					}
				}
			}
			if (\preg_grep('/^' . \preg_quote("^std@_", '/') . '/', $args___)) {
				_F_throw_invalid_argument("Placeholder error");
			}
			return @\call_user_func_array($f___, $args___);
		};
	}

	/*! callable */
	function bind1st(callable $f___, $v___)
	{
		// similar to: return bind($f___, $v___, placeholder::_2);
		// avoiding unnecessary parsing.
		return new _C_binder1st($f___, $v___);
	}

	/*! callable */
	function bind2nd(callable $f___, $v___)
	{
		// similar to: return bind($f___, placeholder::_1, $v___);
		// avoiding unnecessary parsing.
		return new _C_binder2nd($f___, $v___);
	}

	function invoke(callable $f___, ...$args___)
	{
		try {
			return $f___(...$args___);
		} catch(\Throwable $ex) {
			_F_throw_error("Invocation failure : ". $ex->getMessage());
		};
		return null;
	}

	function invokev(callable $f___, array &$args___) 
	{
		try {
			return $f___(...$args___);
		} catch(\Throwable $ex) {
			_F_throw_error("Invocation failure : ". $ex->getMessage());
		};
		return null;
	}

	function unary_negate(callable $f___)
	{
		return function () use ($f___) {
			return !$f___(func_get_arg(0));
		};
	}

	function binary_negate(callable $f___)
	{
		return function () use ($f___) {
			return !$f___(func_get_arg(0), func_get_arg(1));
		};
	}

	function not1(callable $f___)
	{ return unary_negate($f___); }

	function not2(callable $f___)
	{ return binary_negate($f___); }

	function not_fn(callable $f___)
	{
		return function () use ($f___) {
			return !call_user_func_array($f___, func_get_args());
		};
	}

	function count_args(callable $f___)
	{
		$r = (\is_array($f___)
			? new \ReflectionMethod($f___[0], $f___[1])
			: new \ReflectionFunction($f___)
		);
		return $r->getNumberOfParameters();
	}

	function is_unary_function(callable $f___)
	{ return (($f___ instanceof \std\unary_function) || count_args($f___) == 1); }

	function is_binary_function(callable $f___)
	{ return (($f___ instanceof \std\binary_function) || count_args($f___) == 2); }
} /* EONS */
/* EOF */