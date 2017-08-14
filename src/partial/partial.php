<?php

namespace Dash;

function partial($function /* , $arg1, $arg2, ... */)
{
	$fixedArgs = func_get_args();
	array_shift($fixedArgs);  // Removes $function parameter

	$partial = function() use ($function, $fixedArgs) {
		$args = array_merge($fixedArgs, func_get_args());
		return call_user_func_array($function, $args);
	};
	return $partial;
}