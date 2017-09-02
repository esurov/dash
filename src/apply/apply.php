<?php

namespace Dash;

/**
 * Invokes `$callable` with a list of arguments.
 *
 * Note: Contrary to other curried methods, the curried version of this method
 * accepts arguments in the same order as the original method.
 *
 * @category Function
 * @param callable $callable
 * @param iterable $args Arguments to pass to `$callable`
 * @return mixed Return value of `$callable`
 *
 * @example
	$func = function ($time, $name) {
		return "Good $time, $name";
	};

	Dash\apply($func, ['morning', 'John']);
	// === 'Good morning, John'
 *
 * @example Curried version accepts arguments in the same order
	$func = function ($time, $name) {
		return "Good $time, $name";
	};

	$apply = Dash\_apply($func);

	$apply(['morning', 'John']);
	// === 'Good morning, John'
 */
function apply(callable $callable, $args)
{
	assertType($args, 'iterable', __FUNCTION__);
	return call_user_func_array($callable, values($args));
}

/**
 * @codingStandardsIgnoreStart
 */
function _apply(/* callable, args */)
{
	$args = array_merge(['Dash\apply'], func_get_args());
	return call_user_func_array('Dash\curry', $args);
}
