<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_iostream.php
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

namespace
{
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_basic_ios.php";
	
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_collation.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_collator.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_locale.php";

	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_istream.php";
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_ostream.php";
} /* EONS */

namespace std
{
	abstract class ios extends ios_base
	{ /* NOP */ } /* EOC */
} /* EONS */
/* EOF */