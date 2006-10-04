--TEST--
Games_Chess->_getDiagonalColor()
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$phpunit->assertEquals('B', $board->_getDiagonalColor('a1'), 'a1');
$phpunit->assertEquals('W', $board->_getDiagonalColor('b1'), 'b1');
$phpunit->assertEquals('B', $board->_getDiagonalColor('c1'), 'c1');
$phpunit->assertEquals('W', $board->_getDiagonalColor('a2'), 'a2');
$phpunit->assertEquals('B', $board->_getDiagonalColor('b2'), 'b2');
$phpunit->assertEquals('W', $board->_getDiagonalColor('c2'), 'c2');
$phpunit->assertEquals('B', $board->_getDiagonalColor('a3'), 'a3');
$phpunit->assertEquals('W', $board->_getDiagonalColor('b3'), 'b3');
$phpunit->assertEquals('B', $board->_getDiagonalColor('c3'), 'c3');
$phpunit->assertEquals('W', $board->_getDiagonalColor('d3'), 'd3');
$phpunit->assertEquals('B', $board->_getDiagonalColor('e3'), 'e3');
$phpunit->assertEquals('W', $board->_getDiagonalColor('f3'), 'f3');
$phpunit->assertEquals('B', $board->_getDiagonalColor('g3'), 'g3');
$phpunit->assertEquals('W', $board->_getDiagonalColor('h3'), 'h3');
echo 'tests done';
?>
--EXPECT--
tests done