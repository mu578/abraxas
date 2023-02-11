<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_api_signal.php
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
	define('std\SIGHUP' ,  1); /* hangup */
	define('std\SIGINT' ,  2); /* interrupt */
	define('std\SIGQUIT',  3); /* quit */
	define('std\SIGILL' ,  4); /* illegal instruction (not reset when caught) */
	define('std\SIGTRAP',  5); /* trace trap (not reset when caught) */
	define('std\SIGABRT',  6); /* abort program */
	define('std\SIGEMT' ,  7); /* emulate instruction executed */
	define('std\SIGFPE' ,  8); /* floating-point exception */ 
	define('std\SIGKILL',  9); /* kill (cannot be caught or ignored) */
	define('std\SIGBUS' , 10); /* bus error */
	define('std\SIGSEGV', 11); /* segmentation violation */
	define('std\SIGSYS' , 12); /* non-existent system call invoked */
	define('std\SIGPIPE', 13); /* write on a pipe with no reader */
	define('std\SIGALRM', 14); /* real-time timer expired */
	define('std\SIGTERM', 15); /* software termination signal from kill */

	$GLOBALS["^std@_g_strsig"] = [];
	$GLOBALS["^std@_g_strsig"][SIGHUP]  = "HUP";
	$GLOBALS["^std@_g_strsig"][SIGINT]  = "INT";
	$GLOBALS["^std@_g_strsig"][SIGQUIT] = "QUIT";
	$GLOBALS["^std@_g_strsig"][SIGILL]  = "ILL";
	$GLOBALS["^std@_g_strsig"][SIGTRAP] = "TRAP";
	$GLOBALS["^std@_g_strsig"][SIGABRT] = "ABRT";
	$GLOBALS["^std@_g_strsig"][SIGEMT]  = "EMT";
	$GLOBALS["^std@_g_strsig"][SIGFPE]  = "FPE";
	$GLOBALS["^std@_g_strsig"][SIGKILL] = "KILL";
	$GLOBALS["^std@_g_strsig"][SIGBUS]  = "BUS"; 
	$GLOBALS["^std@_g_strsig"][SIGSEGV] = "SEGV"; 
	$GLOBALS["^std@_g_strsig"][SIGSYS]  = "SYS";
	$GLOBALS["^std@_g_strsig"][SIGPIPE] = "PIPE"; 
	$GLOBALS["^std@_g_strsig"][SIGALRM] = "ALRM";
	$GLOBALS["^std@_g_strsig"][SIGTERM] = "TERM";

	function signal(int $sig___, callable $f___ = null)
	{
		switch ($sig___) {
			/* uncatchable */
			case SIGTRAP:
				exit(SIGTRAP);
			break;
			case SIGILL:
				_F_throw_error("Received signal SIGILL, Illegal error.");
				exit(SIGILL);
			break;
			case SIGABRT:
				_F_throw_error("Received signal SIGABRT, Abort error.");
				exit(SIGABRT);
			break;
			case SIGBUS:
				_F_throw_error("Received signal SIGBUS, Bus error.");
				exit(SIGBUS);
			break;
			case SIGKILL:
				exit(SIGKILL);
			break;
		}
		if (!\is_null($f___)) {
			$f___($sig___);
		} else {
			exit($sig___);
		}
		return 0;
	}

	function kill(int $pid___, int $sig___ = SIGKILL)
	{
		if ($sig___ >= 1) {
			if ($pid___ == getpid()) {
				signal($sig___);
			} else if (\function_exists('\posix_kill')) {
				\posix_kill($pid___, $sig___);
			} else if (_F_os_windows()) {
				\exec("taskkill.exe /F /T /PID " . $pid___);
			} else {
				\exec("`which kill` -" . $sig___ . " " . $pid___);
			}
		}
		return 0;
	}

	function raise(int $sig___)
	{ return kill(getpid(), $sig___); }

	function strsignal(int $sig___)
	{
		if (isset($GLOBALS["^std@_g_strsig"][$errno___])) {
			return $GLOBALS["^std@_g_strsig"][$errno___];
		}
		return "";
	}

} /* EONS */
/* EOF */