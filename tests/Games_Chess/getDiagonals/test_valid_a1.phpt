--TEST--
Games_Chess->_getDiagonals() a1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_getDiagonals('a1');
$phpunit->assertEquals(false, $ret['NW'], 'Northwest should not exist');
$phpunit->assertEquals(false, $ret['SE'], 'Southeast should not exist');
$phpunit->assertEquals(false, $ret['SW'], 'Southwest should not exist');
$phpunit->assertEquals(array('b2', 'c3', 'd4', 'e5', 'f6', 'g7', 'h8'),
    $ret['NE'], 'Northeast should contain all the diagonals');
$ret = $board->_getDiagonals('a1', true);
$phpunit->assertEquals(array('b2', 'c3', 'd4', 'e5', 'f6', 'g7', 'h8'),
    $ret, 'simple array');
echo 'tests done';
?>
--EXPECT--
tests done