<?php

class pickTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider cases
	 */
	public function test($input, $pick, $expected)
	{
		$this->assertEquals($expected, Dash\pick($input, $pick));
	}

	public function cases()
	{
		return [

			/*
				Array
			 */

			'Pick none from an empty array' => [
				'input' => [],
				'pick' => null,
				'expected' => [],
			],
			'Pick one from an empty array' => [
				'input' => [],
				'pick' => 'b',
				'expected' => [],
			],
			'Pick several from an empty array' => [
				'input' => [],
				'pick' => ['a', 'c'],
				'expected' => [],
			],

			'Pick none from a non-empty array' => [
				'input' => ['a' => 'one', 'b' => 'two', 'c' => 'three'],
				'pick' => null,
				'expected' => [],
			],
			'Pick one from a non-empty array' => [
				'input' => ['a' => 'one', 'b' => 'two', 'c' => 'three'],
				'pick' => 'b',
				'expected' => ['b' => 'two'],
			],
			'Pick several from a non-empty array' => [
				'input' => ['a' => 'one', 'b' => 'two', 'c' => 'three'],
				'pick' => ['a', 'c'],
				'expected' => ['a' => 'one', 'c' => 'three'],
			],

			/*
				Object
			 */

			'Pick none from an empty object' => [
				'input' => (object) [],
				'pick' => null,
				'expected' => (object) [],
			],
			'Pick one from an empty object' => [
				'input' => (object) [],
				'pick' => 'b',
				'expected' => (object) [],
			],
			'Pick several from an empty object' => [
				'input' => (object) [],
				'pick' => ['a', 'c'],
				'expected' => (object) [],
			],

			'Pick none from a non-empty object' => [
				'input' => (object) ['a' => 'one', 'b' => 'two', 'c' => 'three'],
				'pick' => null,
				'expected' => (object) [],
			],
			'Pick one from a non-empty object' => [
				'input' => (object) ['a' => 'one', 'b' => 'two', 'c' => 'three'],
				'pick' => 'b',
				'expected' => (object) ['b' => 'two'],
			],
			'Pick several from a non-empty object' => [
				'input' => (object) ['a' => 'one', 'b' => 'two', 'c' => 'three'],
				'pick' => ['a', 'c'],
				'expected' => (object) ['a' => 'one', 'c' => 'three'],
			],

			/*
				ArrayObject
			 */

			'Pick none from an empty ArrayObject' => [
				'input' => new ArrayObject([]),
				'pick' => null,
				'expected' => (object) [],
			],
			'Pick one from an empty ArrayObject' => [
				'input' => new ArrayObject([]),
				'pick' => 'b',
				'expected' => (object) [],
			],
			'Pick several from an empty ArrayObject' => [
				'input' => new ArrayObject([]),
				'pick' => ['a', 'c'],
				'expected' => (object) [],
			],

			'Pick none from a non-empty ArrayObject' => [
				'input' => new ArrayObject(['a' => 'one', 'b' => 'two', 'c' => 'three']),
				'pick' => null,
				'expected' => (object) [],
			],
			'Pick one from a non-empty ArrayObject' => [
				'input' => new ArrayObject(['a' => 'one', 'b' => 'two', 'c' => 'three']),
				'pick' => 'b',
				'expected' => (object) ['b' => 'two'],
			],
			'Pick several from a non-empty ArrayObject' => [
				'input' => new ArrayObject(['a' => 'one', 'b' => 'two', 'c' => 'three']),
				'pick' => ['a', 'c'],
				'expected' => (object) ['a' => 'one', 'c' => 'three'],
			],
		];
	}

	/**
	 * @expectedException \InvalidArgumentException
	 * @expectedExceptionMessage Expected a array or object but was given a integer
	 */
	public function testInputType() {
		Dash\pick(42, 'a');
	}
}