<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_combinator.php
//
// Copyright (C) 2017-2018 mu578. All rights reserved.
//
 
/*!
 * @project    Abraxas (Container Library).
 * @brief      Functional combinators library, \(^o^)/ @Haskell.
 * @author     mu578 2018.
 * @maintainer mu578 2018.
 *
 * @copyright  (C) mu578. All rights reserved.
 */

declare(strict_types=1);

namespace std
{
	function & each_in(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable $unaryFunction___
	) : basic_iterable {
		if ($first___::iterator_category === $last___::iterator_category) {
			for_each($first___, $last___, $unaryFunction___);
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $first___->_M_ptr;
	}

	function & every_of(
		  basic_iterator  $first___
		, basic_iterator  $last___
		, bool           &$res___
		, callable        $unaryFunction___
	) : basic_iterable {
		$res___ = false;
		if ($first___::iterator_category === $last___::iterator_category) {
			while ($first___ != $last___) {
				if (!$unaryFunction___($first___->_F_this())) {
					$res___ = false;
					break;
				}
				$res___ = true;
				$first___->_F_next();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $first___->_M_ptr;
	}

	function & nothing_of(
		  basic_iterator  $first___
		, basic_iterator  $last___
		, bool           &$res___
		, callable        $unaryFunction___
	) : basic_iterable {
		$res___ = true;
		if ($first___::iterator_category === $last___::iterator_category) {
			while ($first___ != $last___) {
				if ($unaryFunction___($first___->_F_this())) {
					$res___ = false;
					break;
				}
				$res___ = true;
				$first___->_F_next();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $first___->_M_ptr;
	}

	function & some_of(
		  basic_iterator  $first___
		, basic_iterator  $last___
		, bool           &$res___
		, callable        $unaryFunction___
	) : basic_iterable {
		$res___ = false;
		if ($first___::iterator_category === $last___::iterator_category) {
			while ($first___ != $last___) {
				if ($unaryFunction___($first___->_F_this())) {
					$res___ = true;
					break;
				}
				$res___ = false;
				$first___->_F_next();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $first___->_M_ptr;
	}

	function & apply_mapping(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable $unaryFunction___
	) : basic_iterable {
		if ($first___::iterator_category === $last___::iterator_category) {
			transform($first___, $last___, clone $first___, $unaryFunction___);
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $first___->_M_ptr;
	}

	function & flat_to(
		  basic_iterator  $first___
		, basic_iterator  $last___
		, basic_iterator  $out___
		, callable $unaryOperation___ = null
	) : basic_iterable {
		if ($first___::iterator_category === $last___::iterator_category) {
			$p = $unaryOperation___;
			if (\is_null($p)) {
				$p = function (&$v) { return $v; };
			}
			while ($first___ != $last___) {
				$v = $first___->_F_this();
				if ($v instanceof basic_iterable) {
					flat_to($v->begin(), $v->end(), $out___, $p);
				} else {
					$out___->_F_assign($p($v));
					$out___->_F_next();
				}
				$first___->_F_next();
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $out___->_M_ptr;
	}

	function & to_one(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $binaryPredicate___ = null
	) : basic_iterable {
		if ($first___::iterator_category === $last___::iterator_category) {
			$it = clone $first___;
			sort($it, $last___);
			$it = unique_b($first___, $last___, $binaryPredicate___);
			$it___->_M_ptr->erase($it, $last___);
			return $it___->_M_ptr;
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $first___->_M_ptr;
	}

	function & filter(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $unaryPredicate___
	) : basic_iterable {
		if ($first___::iterator_category === $last___::iterator_category) {
			return filter_if_not($first___, $last___,
				function (&$v) use($unaryPredicate___) {
					return !$unaryPredicate___($v);
				}
			);
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $first___->_M_ptr;
	}

	function & filter_not(
		  basic_iterator $first___
		, basic_iterator $last___
		, callable       $unaryPredicate___
	) : basic_iterable {
		if ($first___::iterator_category === $last___::iterator_category) {
			$it = remove_if($first___, $last___, $unaryPredicate___);
			$it___->_M_ptr->erase($it, $last___);
			return $it___->_M_ptr;
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $first___->_M_ptr;
	}

	function & fold(
		  basic_iterator  $first___
		, basic_iterator  $last___
		, basic_iterator  $out___
		, callable        $binaryOperation___
	) : basic_iterable {
		if ($first___::iterator_category === $last___::iterator_category) {
			if ($first___ == $last___) {
				_F_throw_invalid_argument("Invalid type error");
			} else {
				$buf = $first___->_F_this();
				$first___->_F_next();
				while ($first___ != $last___) {
					$buf = $binaryOperation___($buf, $first___->_F_this());
					$first___->_F_next();
				}
				$out___->_F_assign($buf);
			}
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $out___->_M_ptr;
	}

	function & fold_init(
		  basic_iterator  $first___
		, basic_iterator  $last___
		, basic_iterator  $out___
		,                 $init___
		, callable        $binaryOperation___
	) : basic_iterable {
		if ($first___::iterator_category === $last___::iterator_category) {
			$buf = $init___;
			while ($first___ != $last___) {
				$buf = $binaryOperation___($buf, $first___->_F_this());
				$first___->_F_next();
			}
			$out___->_F_assign($buf);
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $out___->_M_ptr;
	}

	function & combine_to(
		  basic_iterator  $first___
		, basic_iterator  $last___
		, basic_ostream   $out___
		, string          $joint___ = ','
	) : basic_ostream {
		if ($first___::iterator_category === $last___::iterator_category) {
			lazy_copy($first___, $last___, stream_inserter($out___, $joint___));
		} else {
			_F_throw_invalid_argument("Invalid type error");
		}
		return $out___;
	}
} /* EONS */
/* EOF */