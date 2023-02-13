<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_basic_ios.php
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
	require_once __DIR__ . DIRECTORY_SEPARATOR . "scl_basic_utility.php";
} /* EONS */

namespace std
{
	const cin       = '\std\cin';
	const cout      = '\std\cout';
	const cerr      = '\std\cerr';

	const boolalpha = '\std\boolalpha';
	const showbase  = '\std\showbase';
	const hex       = '\std\hex';
	const dec       = '\std\dec';
	const oct       = '\std\oct';

	abstract class char_utils
	{
		const eol = \PHP_EOL;

		const sp   = " ";
		const vt   = "\v";
		const ff   = "\f";
		const ht   = "\t";
		const lf   = "\n";
		const cr   = "\r";
		const crlf = "\r\n";
		const lfcr = "\n\r";
		const nbsp = "&nbsp;";
		const lnbr = "<br>";

		static function to_int($c___)
		{ return unpack_uint8($c___); }
		
		static function to_char($i___)
		{ return pack_uint8($i___); }
	} /* EOC */

	const endl        = char_utils::eol;
	const endline     = char_utils::eol;
	const blank       = char_utils::sp;
	const space       = char_utils::sp;
	const unbreakable = char_utils::nbsp;
	const linebreak   = char_utils::lnbr;
	const tabulation  = char_utils::ht;
	const tab         = char_utils::ht;

	abstract class ios_base
	{
		/* seekdir */
		const beg         = \SEEK_SET;
		const end         = \SEEK_END;
		const cur         = \SEEK_CUR;

		/* openmode */
		const app         = 1 << 0;
		const binary      = 1 << 1;
		const bin         = 1 << 1;
		const in          = 1 << 2;
		const out         = 1 << 3;
		const trunc       = 1 << 4;
		const ate         = 1 << 5;

		/* iostate */
		const goodbit     = 0;
		const badbit      = 1 << 0;
		const failbit     = 1 << 1;
		const eofbit      = 1 << 2;

		/* fmtflags */
		const nomask      = 0;
		const alpha       = 1 << 1;
		const dec         = 1 << 4;
		const hex         = 1 << 6;
		const oct         = 1 << 7;
		const fixed       = 1 << 8;
		const scientific  = 1 << 9;
		const currency    = 1 << 10;
		const showbase    = 1 << 11;
	} /* EOC */

	abstract class basic_ios
	{
		var $_M_locale   = null;
		var $_M_width    = 0;
		var $_M_fill     = char_utils::sp;
		var $_M_sstate   = ios_base::goodbit;
		var $_M_fmtflags = ios_base::nomask;

		function _F_strmode(int $m___)
		{
			$r = '';
			$w = '';
			$a = '';
			if (($m___ & ios_base::in) != 0) {
				$r = 'r';
				if (($m___ & ios_base::bin) != 0) {
					$w = 'rb';
				}
			}

			if (($m___ & ios_base::in|ios_base::out) != 0) {
				$r = 'r+';
				if (($m___ & ios_base::bin) != 0) {
					$w = 'rb+';
				}
			}
			
			if (($m___ & ios_base::out) != 0 ) {
				$w = 'w';
				if (($m___ & ios_base::bin) != 0) {
					$w = 'wb';
				}
			}

			if (($m___ & ios_base::out|ios_base::trunc) != 0) {
				$w = 'w';
				if (($m___ & ios_base::bin) != 0) {
					if (($m___ & ios_base::bin) != 0) {
						$w = 'bw';
					}
				}
			}

			if (($m___ & ios_base::in|ios_base::out|ios_base::trunc) != 0) {
				$w = 'w+';
				if (($m___ & ios_base::bin) != 0) {
					$w = 'bw+';
				}
			}

			if (($m___ & ios_base::out|ios_base::app) != 0) {
				$r = '';
				$w = '';
				$a = 'a';
			}
			if (($m___ & ios_base::in|ios_base::out|ios_base::app) != 0) {
				$r = '';
				$w = '';
				$a = 'a+';
			}
			return $r . $w . $a;
		}

		function & _F_apply_mask(&$v___) 
		{
			if ($this->_M_fmtflags != ios_base::nomask && (\is_float($v___) || \is_integer($v___) || \is_bool($v___))) {
				if (\is_bool($v___) && (($this->_M_fmtflags & ios_base::alpha) != 0)) {
					$v___ = $v___ ? 'true' : 'false';
				} else if (\is_bool($v___)) {
					$v___ = $v___ ? 1 : 0;
				} else if (\is_float($v___) && (($this->_M_fmtflags & ios_base::scientific) != 0)) {
					$numfmt = \numfmt_create('en_US', \NumberFormatter::SCIENTIFIC);
					$v___ = \numfmt_format($numfmt, $v___);
				} else if (\is_float($v___) && (($this->_M_fmtflags & ios_base::fixed) != 0)) {
					$numfmt = \numfmt_create('en_US', \NumberFormatter::DECIMAL);
					\numfmt_set_attribute($numfmt, \NumberFormatter::MIN_FRACTION_DIGITS, 20);
					$v___ = \numfmt_format($numfmt, $v___);
				} else if (\is_float($v___) && (($this->_M_fmtflags & ios_base::fixed) == 0)) {
					$numfmt = \numfmt_create('en_US', \NumberFormatter::DECIMAL);
					\numfmt_set_attribute($numfmt, \NumberFormatter::MAX_FRACTION_DIGITS, 20);
					$v___ = \numfmt_format($numfmt, $v___);
				} else if (\is_numeric($v___) && (($this->_M_fmtflags & ios_base::currency) != 0)) {
					$numfmt = \numfmt_create('en_US', \NumberFormatter::CURRENCY);
					$v___ = \numfmt_format_currency($numfmt, $v___, 'USD');
				} else if (\is_float($v___) && (($this->_M_fmtflags & ios_base::hex) != 0)) {
					if (($this->_M_fmtflags & ios_base::showbase) != 0) {
						$v___ = "0x" . \bin2hex(\pack('f', $v___));
					} else {
						$v___ = \bin2hex(\pack('f', $v___));
					}
				} else if (\is_integer($v___) && (($this->_M_fmtflags & ios_base::hex) != 0)) {
					if (($this->_M_fmtflags & ios_base::showbase) != 0) {
						$v___ = "0x" . \dechex($v___);
					} else {
						$v___ = \dechex($v___);
					}
				} else if (\is_integer($v___) && (($this->_M_fmtflags & ios_base::oct) != 0)) {
					$v___ = \decoct($v___);
				} else if (\is_integer($v___) && (($this->_M_fmtflags & ios_base::alpha) != 0)) {
					$v___ = \chr($v___);
				}
			} else if (\is_bool($v___)) {
				$v___ = $v___ ? 1 : 0;
			}
			if (\is_string($v___)) {
				$this->_M_width = 0;
			} else if ($this->_M_width) {
				$v___ = \str_pad($v___, $this->_M_width, $this->_M_fill, \STR_PAD_LEFT);
			}
			return $v___;
		}

		function & fmtflags_assign(int $fls___)
		{
			$this->_M_fmtflags = $fls___;
			return $this;
		}

		function & fmtflags_clear()
		{
			$this->_M_fmtflags = ios_base::nomask;
			return $this;
		}

		function flags(int $fl___ = ios_base::nomask)
		{
			if ($fl___ == ios_base::nomask) {
				return $this->_M_fmtflags;
			}
			$fl = $this->_M_fmtflags;
			$this->_M_fmtflags = $fl___;
			return $fl;
		}

		function setf(int $fl___, int $mask___ = ios_base::nomask)
		{
			if ($mask___ == ios_base::nomask) {
				$fl = $this->_M_fmtflags;
				$this->_M_fmtflags |= $fl___;
				return $fl;
			}
			$fl = $this->_M_fmtflags;
			$this->unsetf($mask___);
			$this->_M_fmtflags |= $fl___ & $mask___;
			return $fl;
		}

		function unsetf(int $mask___)
		{
			$this->_M_fmtflags &= ~$mask___;
			return $this->_M_fmtflags;
		}

		function imbue(locale &$locale___)
		{ $this->_M_locale = $locale___; }

		function unset_imbue()
		{ $this->_M_locale = null; }

		function getloc()
		{ return $this->_M_locale; }

		function good()
		{ return $this->_M_sstate == 0; }

		function eof()
		{ return ($this->_M_sstate & ios_base::eofbit) != 0; }

		function fail()
		{ return ($this->_M_sstate & (ios_base::badbit|ios_base::failbit)) != 0; }

		function bad()
		{ return ($this->_M_sstate & ios_base::badbit) != 0; }

		function rdstate()
		{ return $this->_M_sstate; }

		function setstate(int $state___)
		{ $this->clear($this->_M_sstate|$state___); }

		function clear(int $state___ = ios_base::goodbit)
		{ $this->_M_sstate = $state___; }
	} /* EOC */

	abstract class basic_istream extends basic_ios
	{
		var $_M_handle_g = null;
		var $_M_count_g  = 0;

		function __toString()
		{ return $this->_M_count_g; }

		function __invoke(&$d___, int $c___ = -1)
		{
			if(!($d___ instanceof basic_ios) && \is_callable($d___)) {
				return $d___($this);
			}
			$this->read($d___, $c___);
			return $this;
		}

		function & read(&$d___, int $c___ = -1)
		{
			if ($c___ > 0) {
				$d___ = \fread($this->_M_handle_g, $d___, $c___);
			} else {
				$d___ = \fread($this->_M_handle_g, $d___);
			}
			if ($d___ === false) {
				$this->setstate(ios_base::badbit|ios_base::failbit);
				$d___ = null;
				$this->_M_count_g = 0;
			} else {
				$this->_M_count_g = memlen($d___);
				if ($this->_M_fmtflags != ios_base::nomask || $this->_M_width > 0) {
					$this->_F_apply_mask($d___);
				}
			}
			if (\feof($this->_M_handle_g)) {
				$this->clear(ios_base::eofbit);
			}
			return $this;
		}

		function readsome(&$d___, int $c___ = -1)
		{
			$this->read($d___, $c___);
			return $this->_M_count_g;
		}

		function & get(&$d___, int $c___ = 1)
		{
			if ($c___ > 0) {
				$d___ = \fgets($this->_M_handle_g, $c___);
			} else {
				$d___ = \fgets($this->_M_handle_g);
			}
			if ($d___ === false) {
				$this->setstate(ios_base::badbit|ios_base::failbit);
				$d___ = null;
				$this->_M_count_g = 0;
			} else {
				$this->_M_count_g = memlen($d___);
				if ($this->_M_fmtflags != ios_base::nomask || $this->_M_width > 0) {
					$this->_F_apply_mask($d___);
				}
			}
			if (\feof($this->_M_handle_g)) {
				$this->clear(ios_base::eofbit);
			}
			return $this;
		}

		function unget()
		{
			if ($this->_M_count_g > 0) {
				if (-1 == \fseek($this->_M_handle_g, -$this->_M_count_g, \SEEK_CUR)) {
					$this->setstate(ios_base::badbit|ios_base::failbit);
					$this->_M_count_g = 0;
				}
			}
			return $this;
		}

		function peek()
		{
			$d = "";
			$this->get($d);
			$this->unget();
			return $d;
		}

		function & getline(&$d___, int $c___, string $delim___ = null)
		{
			if (isset($delim___)) {
				$d___ = \stream_get_line($this->_M_handle_g, $c___, $delim___);
			} else {
				$d___ = \stream_get_line($this->_M_handle_g, $c___);
			}
			
			if ($d___ === false) {
				$this->setstate(ios_base::badbit|ios_base::failbit);
				$d___ = null;
				$this->_M_count_g = 0;
			} else {
				$this->_M_count_g = memlen($d___);
				if ($this->_M_fmtflags != ios_base::nomask || $this->_M_width > 0) {
					$this->_F_apply_mask($d___);
				}
			}
			if (\feof($this->_M_handle_g)) {
				$this->clear(ios_base::eofbit);
			}
			return $this;
		}

		function tellg()
		{
			$this->clear(ios_base::goodbit);
			$r = \ftell($this->_M_handle_g);
			if ($r === false) {
				$this->setstate(ios_base::badbit|ios_base::failbit);
				$r = -1;
			}
			if (\feof($this->_M_handle_g)) {
				$this->clear(ios_base::eofbit);
			}
			return $r;
		}

		function & seekg(int $off___, int $seekdir___ = ios_base::beg)
		{
			$this->clear(ios_base::goodbit);
			if (-1 == \fseek($this->_M_handle_g, $off___, $seekdir___)) {
				$this->setstate(ios_base::badbit|ios_base::failbit);
			}
			if (\feof($this->_M_handle_g)) {
				$this->clear(ios_base::eofbit);
			}
			return $this;
		}

		function gcount()
		{ return $this->_M_count_g; }

		function & swap(basic_istream &$iss___)
		{
			$l = $this->_M_locale;
			$s = $this->_M_sstate;
			$f = $this->_M_fmtflags;
			$h = $this->_M_handle_g;
			$c = $this->_M_count_g;

			$this->_M_locale   = $iss___->_M_locale;
			$this->_M_sstate   = $iss___->_M_sstate;
			$this->_M_fmtflags = $iss___->_M_fmtflags;
			$this->_M_handle_g = $iss___->_M_handle_g;
			$this->_M_count_g  = $iss___->_M_count_g;

			$iss___->_M_locale   = $l;
			$iss___->_M_sstate   = $s;
			$iss___->_M_fmtflags = $f;
			$iss___->_M_handle_g = $h;
			$iss___->_M_count_g  = $c;

			return $this;
		}
	} /* EOC */

	abstract class basic_ostream extends basic_ios
	{
		function __toString()
		{ return $this->_M_count_p; }

		var $_M_handle_p = null;
		var $_M_count_p  = 0;

		function __invoke($d___)
		{
			if(!($d___ instanceof basic_ios) && \is_callable($d___)) {
				return $d___($this);
			}
			return $this->write($d___);
		}

		function & write($d___, int $c___ = -1)
		{
			if ($this->_M_handle_p === null) {
				$this->setstate(ios_base::badbit|ios_base::failbit);
				$this->_M_count_p = 0;
				return $this;
			}

			$r = false;
			if ($c___ > 0) {
				$r = \fwrite($this->_M_handle_p, $d___, $c___);
			} else {
				if ($this->_M_fmtflags != ios_base::nomask || $this->_M_width > 0) {
					$this->_F_apply_mask($d___);
				}
				$r = \fwrite($this->_M_handle_p, $d___);
			}
			if ($r === false) {
				$this->setstate(ios_base::badbit|ios_base::failbit);
				$this->_M_count_p = 0;
			} else {
				$this->_M_count_p = $r;
			}
			return $this;
		}

		function & put($ch___)
		{
			$this->write($ch___);
			return $this;
		}
		
		function & flush()
		{
			if ($this->_M_handle_p === null) {
				$this->setstate(ios_base::badbit|ios_base::failbit);
				$this->_M_count_p = 0;
				return $this;
			}

			if (\fflush($this->_M_handle_p) === false) {
				$this->setstate(ios_base::badbit);
				$this->_M_count_p = 0;
			}
			return $this;
		}

		function tellp()
		{
			if ($this->_M_handle_p === null) {
				$this->setstate(ios_base::badbit|ios_base::failbit);
				$this->_M_count_p = 0;
				return -1;
			}

			$r = \ftell($this->_M_handle_p);
			if ($r === false) {
				$r = -1;
			}
			return $r;
		}

		function & seekp(int $off___, int $seekdir___ = ios_base::beg)
		{
			if ($this->_M_handle_p === null) {
				$this->setstate(ios_base::badbit|ios_base::failbit);
				$this->_M_count_p = 0;
				return $this;
			}

			$this->clear(ios_base::goodbit);
			if (-1 == \fseek($this->_M_handle_p, $off___, $seekdir___)) {
				$this->setstate(ios_base::badbit|ios_base::failbit);
			}
			if (\feof($this->_M_handle_p)) {
				$this->clear(ios_base::eofbit);
			}
			return $this;
		}
		
		function pcount()
		{ return $this->_M_count_p ; }

		function & swap(basic_ostream &$oss___)
		{
			$l = $this->_M_locale;
			$s = $this->_M_sstate;
			$f = $this->_M_fmtflags;
			$h = $this->_M_handle_p;
			$c = $this->_M_count_p;

			$this->_M_locale   = $oss___->_M_locale;
			$this->_M_sstate   = $oss___->_M_sstate;
			$this->_M_fmtflags = $oss___->_M_fmtflags;
			$this->_M_handle_p = $oss___->_M_handle_p;
			$this->_M_count_p  = $oss___->_M_count_p;

			$oss___->_M_locale   = $l;
			$oss___->_M_sstate   = $s;
			$oss___->_M_fmtflags = $f;
			$oss___->_M_handle_p = $h;
			$oss___->_M_count_p  = $c;

			return $this;
		}
	} /* EOC */

	class basic_istringstream extends basic_istream
	{
		function __toString()
		{ return $this->str(); }

		function __construct(string &$buf)
		{
			$this->_M_handle_g = \fopen('php://memory', 'wb+');
			if ($this->_M_handle_g === false) {
				$this->setstate(ios_base::badbit|ios_base::failbit);
				$this->_M_handle_g = null;
			} else {
				$r = \fwrite($this->_M_handle_g, $buf);
				if ($r === false) {
					$this->setstate(ios_base::badbit|ios_base::failbit);
				}
			}
		}

		function __destruct()
		{
			if ($this->_M_handle_g !== null) {
				\fclose($this->_M_handle_g);
			}
		}

		function & str()
		{
			$str = "";
			$off = \ftell($this->_M_handle_g);
			if ($off === false) {
				$this->setstate(ios_base::badbit|ios_base::failbit);
				$off = -1;
			} else {
				if (-1 == \fseek($this->_M_handle_g, 0, \SEEK_SET)) {
					$this->setstate(ios_base::badbit|ios_base::failbit);
				} else {
					$str = \stream_get_contents($this->_M_handle_g);
					if ($str === false) {
						$str = "";
						$this->_M_count_g = 0;
					} else {
						$this->_M_count_g = memlen($str);
					}
					if (-1 == \fseek($this->_M_handle_g, $off, \SEEK_SET)) {
						$this->setstate(ios_base::badbit|ios_base::failbit);
					}
					if (\feof($this->_M_handle_g)) {
						$this->clear(ios_base::eofbit);
					}
				}
			}
			return $str;
		}
		
		function data()
		{ return $this->str(); }

	} /* EOC */

	class basic_ostringstream extends basic_ostream
	{
		function __toString()
		{ return $this->str(); }

		function __construct()
		{
			$this->_M_handle_p = \fopen('php://memory', 'wb+');
			if ($this->_M_handle_p === false) {
				$this->setstate(ios_base::badbit|ios_base::failbit);
				$this->_M_handle_p = null;
			}
		}

		function __destruct()
		{
			if ($this->_M_handle_p !== null) {
				\fclose($this->_M_handle_p);
			}
		}

		function & str()
		{
			$str = "";
			$off = \ftell($this->_M_handle_p);
			if ($off === false) {
				$this->setstate(ios_base::badbit|ios_base::failbit);
				$off = -1;
			} else {
				if (-1 == \fseek($this->_M_handle_p, 0, \SEEK_SET)) {
					$this->setstate(ios_base::badbit|ios_base::failbit);
				} else {
					$str = \stream_get_contents($this->_M_handle_p);
					if ($str === false) {
						$str = "";
					}
					if (-1 == \fseek($this->_M_handle_p, $off, \SEEK_SET)) {
						$this->setstate(ios_base::badbit|ios_base::failbit);
					}
					if (\feof($this->_M_handle_p)) {
						$this->clear(ios_base::eofbit);
					}
				}
			}
			return $str;
		}

		function data()
		{ return $this->str(); }
	} /* EOC */

	class basic_ifstream extends basic_istream
	{
		function _F_get_mode($h___)
		{
			if ($this->_M_handle_g !== null && \is_resource($h___)) {
				return \stream_get_meta_data($this->_M_handle_g)['mode'];
			}
			return '';
		}

		function _F_set_handle($h___)
		{
			if (\is_resource($h___)) {
				$mode = $this->_F_get_mode($this->_M_handle_g);
				if ($mode == 'rb' || $mode == 'r') {
					$this->_M_handle_g = $h___;
				}
			}
		}

		function __destruct()
		{
			if ($this->_M_handle_p !== null) {
				\fclose($this->_M_handle_p);
			}
		}

		function open(string $fname___, int $m___ = ios_base::in)
		{
			$this->_M_handle_g = \fopen($fname___, $this->_F_strmode($m___));
			if ($this->_M_handle_g === false) {
				$this->setstate(ios_base::badbit|ios_base::failbit);
				$this->_M_handle_g = null;
			} else {
				if (($m___ & ios_base::ate) != 0) {
					if (-1 == \fseek($this->_M_handle_g, $off___, $seekdir___)) {
						$this->setstate(ios_base::badbit|ios_base::failbit);
						\fclose($this->_M_handle_g);
						$this->_M_handle_g = null;
					}
					if ($this->_M_handle_g !== null && \feof($this->_M_handle_g)) {
						$this->clear(ios_base::eofbit);
					}
				}
			}
		}

		function is_open()
		{ return $this->_M_handle_g !== null; }

		function close()
		{
			if ($this->_M_handle_g !== null) {
				\fclose($this->_M_handle_g);
				$this->_M_handle_g = null;
			}
		}
	} /* EOC */

	final class _C_ostream_cin extends basic_istream
	{
		function __invoke(&$d___, int $c___ = -1)
		{ return $this->get($d___, $c___); }

		function __construct()
		{ $this->_M_handle_g = \STDIN; }
	} /* EOC */

	final class _C_ostream_cout extends basic_ostream
	{
		function __construct()
		{ $this->_M_handle_p = \STDOUT; }
	} /* EOC */

	final class _C_ostream_cerr extends basic_ostream
	{
		function __construct()
		{ $this->_M_handle_p = \STDERR; }
	} /* EOC */

	function & cin(&$d___ = null)
	{
		static $_S_cin = null;
		if (\is_null($_S_cin)) {
			$_S_cin = new _C_ostream_cin;
		}
		if (!\is_null($d___)) {
			$_S_cin = $_S_cin($d___);
		}
		return $_S_cin;
	}

	function & cout($d___ = null)
	{
		static $_S_cout = null;
		if (\is_null($_S_cout)) {
			$_S_cout = new _C_ostream_cout;
		}
		if (!\is_null($d___)) {
			$_S_cout = $_S_cout($d___);
		}
		return $_S_cout;
	}

	function & cerr($d___ = null)
	{
		static $_S_cerr = null;
		if (\is_null($_S_cerr)) {
			$_S_cerr = new _C_ostream_cerr;
		}
		if (!\is_null($d___)) {
			$_S_cerr = $_S_cerr($d___);
		}
		return $_S_cerr;
	}

	function setw(int $n___)
	{
		return function & (basic_ios &$ios___) use ($n___)
		{
			$ios___->_M_width = $n___;
			return $ios___;
		};
	}

	function setfill(string $ch___)
	{
		return function & (basic_ios &$ios___) use ($ch___)
		{
			$ios___->_M_fill = $ch___;
			return $ios___;
		};
	}

	function boolalpha(bool $set___)
	{
		return function & (basic_ios &$ios___) use ($set___)
		{
			$set___ ?
				  $ios___->setf(ios_base::alpha)
				: $ios___->unsetf(ios_base::alpha);
			return $ios___;
		};
	}

	function hex(bool $set___)
	{
		return function & (basic_ios &$ios___) use ($set___)
		{
			$set___ ?
				  $ios___->setf(ios_base::hex)
				: $ios___->unsetf(ios_base::hex);
			return $ios___;
		};
	}

	function dec(bool $set___)
	{
		return function & (basic_ios &$ios___) use ($set___)
		{
			$set___ ?
				  $ios___->setf(ios_base::dec)
				: $ios___->unsetf(ios_base::dec);
			return $ios___;
		};
	}

	function oct(bool $set___)
	{
		return function & (basic_ios &$ios___) use ($set___)
		{
			$set___ ?
				  $ios___->setf(ios_base::oct)
				: $ios___->unsetf(ios_base::oct);
			$ios___->setf(ios_base::hex);
			return $ios___;
		};
	}

	function showbase(bool $set___)
	{
		return function & (basic_ios &$ios___) use ($set___)
		{
			$set___ ?
				  $ios___->setf(ios_base::showbase)
				: $ios___->unsetf(ios_base::showbase);
			return $ios___;
		};
	}

	function setiosflags(int $fmtflgs___)
	{
		return function & (basic_ios &$ios___) use ($fmtflgs___)
		{
			$ios___->setf($fmtflgs___);
			return $ios___;
		};
	}

	function resetiosflags(int $fmtflgs___)
	{
		return function & (basic_ios &$ios___) use ($fmtflgs___)
		{
			$ios___->unsetf($fmtflgs___);
			return $ios___;
		};
	}
} /* EONS */
/* EOF */