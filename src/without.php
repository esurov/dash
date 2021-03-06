<?php

namespace Dash;

/**
 * @incomplete
 * Returns a new array of $iterable that excludes all values in $exclude, using loose equality for comparison.
 *
 * @param iterable|stdClass $iterable
 * @param array $exclude Values to exclude
 * @return array Subset of $iterable
 *
 * @example
	without(['a', 'b', 'c', 'd'], ['b', 'c']);
	// === ['a', 'd']
 */
function without($iterable, $exclude)
{
	$without = reject($iterable, function ($value) use ($exclude) {
		return contains($exclude, $value);
	});

	return $without;
}
