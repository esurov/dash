<?php

namespace Dash;

/**
 * Gets the minimum value of all elements in `$iterable`.
 *
 * @param iterable|stdClass|null $iterable
 * @return mixed|null Null if `$iterable` is empty
 *
 * @example
	Dash\min([3, 8, 2, 5]);
	// === 2

	Dash\min([]);
	// === null
 */
function min($iterable)
{
	assertType($iterable, ['iterable', 'stdClass', 'null'], __FUNCTION__);

	if (size($iterable) === 0) {
		return null;
	}

	$min = reduce($iterable, function ($min, $value) {
		return \min($min, $value);
	}, +INF);

	return $min;
}
