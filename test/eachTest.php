<?php

use Dash\_;

class eachTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForEach
	 */
	public function testStandaloneEach($collection, $expected)
	{
		$self = $this;
		$iterated = [];
		$iteratee = function($value, $key, $collection2) use ($self, $collection, &$iterated) {
			$self->assertSame($collection, $collection2);
			$iterated[] = $key . ' is ' . $value;
		};

		Dash\each($collection, $iteratee);
		$this->assertEquals($expected, $iterated);
	}

	/**
	 * @dataProvider casesForEach
	 */
	public function testChainedEach($collection, $expected)
	{
		$self = $this;
		$iterated = [];
		$iteratee = function($value, $key, $collection) use ($self, &$iterated) {
			$iterated[] = $key . ' is ' . $value;
		};

		$chain = _::chain($collection);
		$chain->each($iteratee)->value();
		$this->assertEquals($expected, $iterated);
	}

	public function casesForEach()
	{
		return array(
			'With an empty array' => array(
				[],
				[]
			),
			'With an indexed array' => array(
				array(
					'first',
					'second',
					'third',
				),
				array(
					'0 is first',
					'1 is second',
					'2 is third',
				),
			),
			'With an associative array' => array(
				array(
					'a' => 'first',
					'b' => 'second',
					'c' => 'third',
				),
				array(
					'a is first',
					'b is second',
					'c is third',
				),
			),
			'With an empty object' => array(
				(object) [],
				[]
			),
			'With a non-empty object' => array(
				(object) array(
					'a' => 'first',
					'b' => 'second',
					'c' => 'third',
				),
				array(
					'a is first',
					'b is second',
					'c is third',
				),
			),
			'With an empty ArrayObject' => array(
				new ArrayObject([]),
				[],
			),
			'With a non-empty ArrayObject' => array(
				new ArrayObject(array(
					'a' => 'first',
					'b' => 'second',
					'c' => 'third',
				)),
				array(
					'a is first',
					'b is second',
					'c is third',
				),
			),
		);
	}
}