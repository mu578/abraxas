<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_random.php
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
	final class random_device
	{
		var $_M_dev  = null;
		var $_M_ent  = 0.0;
		var $_M_ini  = 0x0;
		var $_M_seed = 0;

		static function min() { return 0; }
		static function max() { return 0x7FFFFFFF; }

		function __invoke(int $sz = 4)
		{ return ($this->_M_dev)($sz); }

		function __construct()
		{
			$this->_M_dev = _F_random_slot($this->_M_ent);
			$this->reset();
		}

		function seed()
		{ return $this->_M_seed; }

		function reset()
		{
			$this->_M_ini = \bin2hex(($this->_M_dev)(32));
			for ($i = 0; $i < 64; $i++) {
				$this->_M_seed += \ord($this->_M_ini[$i]);
			}
		}

		function entropy()
		{ return $this->_M_ent; }
	} /* EOC */

	abstract class pseudo_random_engine 
	{
		var $_M_dev = null;

		static function min()
		{ return 0; }

		static function max()
		{ return 0x7FFFFFFF; }

		function seed(int $x = -1)
		{ /* NOP */ }

		function discard(int $n)
		{ /* NOP */ }
	}

	final class cryptographically_secure_engine extends pseudo_random_engine
	{
		static function min()
		{ return 0; }

		static function max()
		{ return 0x7FFFFFFF; }

		function __construct(random_device $dev = null)
		{
			$this->_M_dev = null;
			$this->discard(1);
		}

		function __destruct()
		{ $this->_M_dev = null; }

		function __invoke(int $a = numeric_limits_int::max, int $b = numeric_limits_int::max)
		{
			if ($a === numeric_limits_int::max) {
				$a = cryptographically_secure_engine::min();
			}

			if ($b === numeric_limits_int::max) {
				$b = cryptographically_secure_engine::max();
			}

			if ($b < $a) {
				$c = $b;
				$b = $a;
				$a = $c;
			}
			return @\random_int($a, $b);
		}

		function seed(int $x = -1)
		{ /* NOP */ }

		function discard(int $n)
		{
			for ($i = 0; $i < $n; $i++) {
				@\random_int(
					  mersenne_twister_engine::min()
					, mersenne_twister_engine::max()
				);
			}
		}
	} /* EOC */

	final class mersenne_twister_engine extends pseudo_random_engine
	{
		function __construct(random_device $dev = null)
		{
			$this->_M_dev = \is_null($dev) ? new random_device : $dev;
			$this->discard(1);
		}

		function __destruct()
		{ $this->_M_dev = null; }

		function __invoke(int $a = numeric_limits_int::max, int $b = numeric_limits_int::max)
		{
			if ($a === numeric_limits_int::max) {
				$a = mersenne_twister_engine::min();
			}

			if ($b === numeric_limits_int::max) {
				$b = mersenne_twister_engine::max();
			}

			if ($b < $a) {
				$c = $b;
				$b = $a;
				$a = $c;
			}
			return @\mt_rand($a, $b);
		}

		function seed(int $x = -1)
		{
			if ($x < 1) {
				$this->_M_dev->reset();
				$x = $this->_M_dev->seed();
			}
			@\mt_srand($x, \MT_RAND_MT19937);
		}

		function discard(int $n)
		{
			for ($i = 0; $i < $n; $i++) {
				@\mt_rand(
					  mersenne_twister_engine::min()
					, mersenne_twister_engine::max()
				);
			}
		}
	} /* EOC */

	class normal_distribution
	{
		var $_M_mean   = 0.0;
		var $_M_stddev = 1.0;
		var $_M_reset  = 0;

		function __construct(float $mean = 0.0, $stddev = 1.0)
		{
			$this->_M_mean   = $mean;
			$this->_M_stddev = $stddev;
			if ($this->_M_stddev < 1.0) {
				$this->_M_stddev = 1.0;
			}
		}

		function mean()
		{ return $this->_M_mean; }

		function stddev()
		{ return $this->_M_stddev; }

		function min()
		{ return -numeric_limits::infinity; }

		function max()
		{ return numeric_limits::infinity; }

		function reset()
		{ $this->_M_r = 1; }
	} /* EOC */

	final class uniform_int_distribution
	{
		var $_M_a = 0;
		var $_M_b = -1;
		var $_M_r = 0;

		function min() { return $this->_M_a; }
		function max() { return $this->_M_b; }

		function __construct(int $a = 0, int $b = -1)
		{
			$this->_M_a = $a;
			$this->_M_b = $b;
			$this->_M_r = 0;
		}

		function __invoke(
			  pseudo_random_engine &$gen
			, int $a = numeric_limits_int::max
			, int $b = numeric_limits_int::max
		) {
			if ($this->_M_r > 0) {
				$this->_M_r = 0;
				$gen->seed();
				$gen->discard(1);
			}

			if ($a === numeric_limits_int::max) {
				$a = $this->_M_a;
			}

			if ($b === numeric_limits_int::max) {
				$b = $this->_M_b;
			}

			return $gen($a, $b);
		}

		function reset()
		{ $this->_M_r = 1; }

		function a()
		{ return $this->_M_a; }

		function b()
		{ return $this->_M_b; }
	} /* EOC */

	final class uniform_real_distribution
	{
		var $_M_a = 0.0;
		var $_M_b = 1.0;
		var $_M_r = 0;

		function min() { return $this->_M_a; }
		function max() { return $this->_M_b; }

		function __construct(float $a = 0.0, float $b = 1.0)
		{
			$this->_M_a = $a;
			$this->_M_b = $b;
			$this->_M_r = 0;
		}

		function __invoke(pseudo_random_engine &$gen, float $a = 0.0, float $b = 0.0)
		{
			if ($this->_M_r > 0) {
				$this->_M_r = 0;
				$gen->seed();
				$gen->discard(1);
			}

			if ($a == 0.0 && $b == 0.0) {
				return (
					  $this->_M_a
					+ ($gen($gen::min(), $gen::max()) / $gen::max())
					* ($this->_M_b - $this->_M_a)
				);
			}

			if ($b < $a) {
				$c = $b;
				$b = $a;
				$a = $c;
			}
			return ($a + ($gen($gen::min(), $gen::max()) / $gen::max()) * ($b - $a));
		}

		function reset()
		{ $this->_M_r = 1; }

		function a()
		{ return $this->_M_a; }

		function b()
		{ return $this->_M_b; }
	} /* EOC */
} /* EONS */
/* EOF */