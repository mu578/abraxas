<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_basic_iterator.php
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
	abstract class basic_iterator_tag
	{
		const basic_iterator        = 10;
		const forward_iterator      = 20;
		const reverse_iterator      = 30;
		const insert_iterator       = 40;
		const zip_iterator          = 50;

		const back_insert_iterator  = 41;
		const front_insert_iterator = 42;
		const ostream_iterator      = 41;

		
	} /* EOC */

	abstract class basic_iterator
	{
		const iterator_category = basic_iterator_tag::basic_iterator;
	} /* EOC */

	abstract class forward_iterator extends basic_iterator
		implements _I_bidirectional_iterator
	{
		const iterator_category = basic_iterator_tag::forward_iterator;
		
		use _T_basic_iterator;
		use _T_forward_iterator;

		function first()
		{ return $this->_F_first(); }

		function second()
		{ return $this->_F_second(); }

		function & assign($val___)
		{
			$this->_F_assign($val___);
			return $this;
		}

		function & advance(int $d___ = 1)
		{
			$this->_F_advance($d___);
			return $this;
		}

		function & prev()
		{
			if ($this->_M_pos > 0) {
				--$this->_M_pos;
			}
			return $this;
		}

		function & next()
		{
			return $this->_F_advance(1);
			return $this;
		}
	} /* EOC */

	abstract class reverse_iterator extends basic_iterator
		implements _I_bidirectional_iterator
	{
		const iterator_category = basic_iterator_tag::reverse_iterator;

		use _T_basic_iterator;
		use _T_reverse_iterator;
		
		function first()
		{ return $this->_F_first(); }

		function second()
		{ return $this->_F_second(); }
		
		function & assign($val___)
		{
			$this->_F_assign($val___);
			return $this;
		}

		function & advance(int $d___ = 1)
		{
			$this->_F_advance($d___);
			return $this;
		}

		function & prev()
		{
			if ($this->_M_pos < $this->_M_ptr->_M_size -1) {
				++$this->_M_pos;
			}
			return $this;
		}

		function & next()
		{
			$this->_F_advance(1);
			return $this;
		}
	} /* EOC */

	abstract class insert_iterator extends basic_iterator
		implements _I_bidirectional_iterator
	{
		const iterator_category = basic_iterator_tag::insert_iterator;

		function first()
		{ return $this->_F_first(); }

		function second()
		{ return $this->_F_second(); }

		function & assign($val___)
		{
			$this->_F_assign($val___);
			return $this;
		}

		function & advance(int $d___ = 1)
		{
			$this->_F_advance($d___);
			return $this;
		}

		function & prev()
		{
			if ($this->_M_pos > 0) {
				--$this->_M_pos;
			}
			return $this;
		}

		function & next()
		{
			$this->advance(1);
			return $this;	
		}
	} /* EOC */

	final class _C_forward_iterator_langarray extends forward_iterator
	{ use _T_forward_iterator_langarray; }

	final class _C_forward_iterator_linkedlist extends forward_iterator
	{ use _T_forward_iterator_linkedlist; }

	final class _C_forward_iterator_dict extends forward_iterator
	{ use _T_forward_iterator_dict; }

	final class _C_forward_iterator_map extends forward_iterator
	{ use _T_forward_iterator_map; }

	final class _C_reverse_iterator_langarray extends reverse_iterator
	{ use _T_reverse_iterator_langarray; }

	final class _C_reverse_iterator_linkedlist extends reverse_iterator
	{ use _T_reverse_iterator_linkedlist; }

	final class _C_reverse_iterator_dict extends reverse_iterator
	{ use _T_reverse_iterator_dict; }

	final class _C_reverse_iterator_map extends reverse_iterator
	{ use _T_reverse_iterator_map; }

	final class front_insert_iterator extends insert_iterator
	{
		const iterator_category = basic_iterator_tag::front_insert_iterator;

		use _T_basic_iterator;
		use _T_inserter_iterator;
	} /* EOC */

	final class back_insert_iterator extends insert_iterator
	{
		const iterator_category = basic_iterator_tag::back_insert_iterator;

		use _T_basic_iterator;
		use _T_inserter_iterator;
	} /* EOC */

	final class ostream_iterator extends insert_iterator
	{
		const iterator_category = basic_iterator_tag::ostream_iterator;

		use _T_basic_iterator;
		use _T_ostream_iterator;

		function first()
		{ return $this->_F_first(); }

		function second()
		{ return $this->_F_second(); }
		
		function & assign($val___)
		{
			$this->_F_assign($val___);
			return $this;
		}

		function & advance(int $d___ = 1)
		{
			$this->_F_advance($d___);
			return $this;
		}

		function & prev()
		{
			$this->_F_prev();
			return $this;
		}

		function & next()
		{
			$this->_F_next();
			return $this;
		}
	} /* EOC */

	final class zip_iterator extends basic_iterator
	{
		const iterator_category = basic_iterator_tag::zip_iterator;

		use _T_basic_iterator;
		use _T_zip_iterator;

		function first()
		{ return $this->_F_first(); }

		function second()
		{ return $this->_F_second(); }
		
		function & assign($val___)
		{
			$this->_F_assign($val___);
			return $this;
		}

		function & advance(int $d___ = 1)
		{
			$this->_F_advance($d___);
			return $this;
		}

		function & prev()
		{
			$this->_F_prev();
			return $this;
		}

		function & next()
		{
			$this->_F_next();
			return $this;
		}
	} /* EOC */
} /* EONS */
/* EOF */