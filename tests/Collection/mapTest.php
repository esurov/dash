<?php

use Dash\Collection;
use Dash\Container;

class mapTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider casesForMap
	 */
	public function testMap($collection, $expected)
	{
		$self = $this;
		$iteratee = function($value, $key, $collection2) use ($self, $collection) {
			$self->assertSame($collection, $collection2);
			return $key . ' is ' . $value;
		};

		// As a standalone operation
		$actual = Collection\map($collection, $iteratee);
		$this->assertEquals($expected, $actual);

		// As a chained operation
		$container = new Container($collection);
		$actual = $container->map($iteratee)->value();
		$this->assertEquals($expected, $actual);
	}

	public function casesForMap()
	{
		return array(
			'With an empty array' => array(
				array(),
				array()
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
				(object) array(),
				array()
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
				new ArrayObject(array()),
				array()
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
