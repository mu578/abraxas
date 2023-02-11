<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_api_baselib.php
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
	define('std\EXIT_SUCCESS', 0);
	define('std\EXIT_FAILURE', -1);

	function stop(int $status___ = 0)
	{ exit($status___); }

	function abort()
	{ signal(SIGABRT); }

	function trap()
	{ assert(1 == 0); }

	function assert($expr___, string $msg___ = "") 
	{
		if ($expr___) {
			return;
		}
		$stack = \debug_backtrace();
		$stack = $stack[\count($stack) -1];
		\fprintf(\STDERR, "Assertion error: %s" . \PHP_EOL, $msg___);
		\fprintf(\STDERR,
			"%s:%d %s()" . \PHP_EOL
			, $stack['file']
			, $stack['line']
			, $stack['function']
		);
		\fprintf(\STDERR, "Abort trap: %d"  . \PHP_EOL, SIGABRT);
		\fflush(\STDERR);
		abort();
	}

	function terminate()
	{ signal(SIGQUIT); }

	function err(int $e___, string $fmt___, ...$args___)
	{ \fwrite(\STDERR, \vsprintf("+ err(" . $e___ . ")" . $fmt___ . \PHP_EOL, $args___)); }

	function errx(int $e___, string $fmt___, ...$args___)
	{
		err($e___, $fmt___, ...$args___);
		exit($e___);
	}

	function warn(int $e___, string $fmt___, ...$args___)
	{ \fwrite(\STDERR, \vsprintf("+ warn(" . $e___ . ")" . $fmt___ . \PHP_EOL, $args___)); }

	function warnx(int $e___, string $fmt___, ...$args___)
	{
		warn($e___, $fmt___, ...$args___);
		exit($e___);
	}
} /* EONS */
/* EOF */