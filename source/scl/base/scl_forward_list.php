<?php
# -*- coding: utf-8, tab-width: 3 -*-

//
// scl_basic_forward_list.php
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
	final class forward_list extends basic_forward_list
	{
		use _T_multi_construct;

		function __construct()
		{
			parent::__construct();
			$this->_F_multi_construct(func_num_args(), func_get_args());
		}

		function forward_list_1(array $list_initializer)
		{
			foreach ($list_initializer as &$val) {
				$this->push_back($val);
			}
		}

		function forward_list_2(basic_iterator $first, basic_iterator $last)
		{ $this->assign($first, $last); }

		function & reserve(int $size, $fill = null)
		{
			_F_reserve($this, $size, $fill);
			return $this;
		}

		function & push_front($val)
		{
			$this->_F_insert_first($val);
			return $this;
		}

		function & push_back($val)
		{
			$this->_F_insert_last($val);
			return $this;
		}

		function & pop_front()
		{
			$this->_F_del_first();
			return $this;
		}

		function & pop_back()
		{
			$this->_F_del_last();
			return $this;
		}

		function at(int $index)
		{
			if ($index >= 0 && $index < $this->_M_size) {
				return $this->_F_get_at($index);
			}
			_F_throw_out_of_range("Out of Range error");
			return null;
		}

		function & insert_at(int $index, $val)
		{
			$this->_F_insert_at_index($index, $val);
			return $this;
		}

		function & insert(basic_iterator $first, basic_iterator $last)
		{
			if ($first::iterator_category === $last::iterator_category) {
				while ($first != $last) {
					$this->insert_at($first->_F_pos(), $first->_F_this());
					$first->next();
				}
			} else {
				_F_throw_invalid_argument("Invalid type error");
			}
			return $this;
		}

		function & insert_after_at(int $index, $val)
		{
			$this->_F_insert_after_index($index, $val);
			return $this;
		}
		
		function & insert_after(basic_iterator $first, basic_iterator $last)
		{
			if ($first::iterator_category === $last::iterator_category) {
				while ($first != $last) {
					$this->insert_after($first->_F_pos(), $first->_F_this());
					$first->next();
				}
			} else {
				_F_throw_invalid_argument("Invalid type error");
			}
			return $this;
		}

		function & swap(forward_list &$fwdl)
		{
			$this->_F_swap($fwdl);
			return $this;
		}

		function & assign_from(forward_list &$fwdl)
		{
			_F_clear_all($this);
			$this->_F_merge($fwdl, $val);
			return $this;
		}

		function & assign(basic_iterator $first, basic_iterator $last)
		{
			$this->_F_clear_all();
			$this->merge($first, $last);
			return $this;
		}

		function & merge_from(forward_list &$fwdl)
		{
			$this->_F_merge($fwdl, $val);
			return $this;
		}

		function & merge(basic_iterator $first, basic_iterator $last)
		{
			if ($first::iterator_category === $last::iterator_category) {
				while ($first != $last) {
					$this->push_back($first->second());
					$first->next();
				}
			} else {
				_F_throw_invalid_argument("Invalid type error");
			}
			return $this;
		}

		function & remove($val)
		{
			$cnt = $this->_F_find_data($val);
			for ($i = 0; $i < $cnt; $i++) {
				$this->_F_del_data($val);
			}
			return $this;
		}

		function & remove_if(callable $unaryPredicate)
		{
			$this->_F_del_if($unaryPredicate);
			return $this;
		}

		function & erase_at(int $index)
		{
			$this->_F_del_at($index);
			return $this;
		}

		function & erase_after(int $index)
		{
			$this->_F_del_at($index + 1);
			return $this;
		}

		function & erase_before(int $index)
		{
			$this->_F_del_at($index - 1);
			return $this;
		}

		function & erase(basic_iterator $first, basic_iterator $last)
		{
			_F_splice($this, $first->_F_pos(), distance($first, $last));
			return $this;
		}

		function & slice_erase(int $start, int $end)
		{
			_F_splice($this, $start, ($end - $start));
			return $this;
		}

		function & sort(callable $compare = null)
		{
			if ($this->_M_size) {
				_F_sort_all($this, $compare);
			}
			return $this;
		}

		function & stable_sort(callable $compare = null)
		{
			if ($this->_M_size) {
				_F_stable_sort_all($this, $compare);
			}
			return $this;
		}

		function & reverse_sort(callable $compare = null)
		{
			if ($this->_M_size) {
				_F_reverse($this);
				_F_sort_all($this, $compare);
			}
			return $this;
		}

		function & reverse_stable_sort(callable $compare = null)
		{
			if ($this->_M_size) {
				_F_reverse($this);
				_F_stable_sort_all($this, $compare);
			}
			return $this;
		}

		function & reverse()
		{
			_F_reverse($this);
			return $this;
		}

		function empty()
		{ return ($this->_M_f_node === null); }

		function size()
		{ return $this->_M_size; }

		function & clear()
		{
			_F_clear_all($this);
			return $this;
		}
	} /* EOC */
} /* EONS */
/* EOF */