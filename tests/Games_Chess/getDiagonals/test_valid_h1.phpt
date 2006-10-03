--TEST--
Games_Chess->_getDiagonals() h1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_getDiagonals('h1');
$phpunit->assertEquals(false, $ret['NE'], 'Northwest should not exist');
$phpunit->assertEquals(false, $ret['SW'], 'Southwest should not exist');
$phpunit->assertEquals(false, $ret['SE'], 'Southeast should not exist');
$phpunit->assertEquals(array('g2', 'f3', 'e4', 'd5', 'c6', 'b7', 'a8'),
    $ret['NW'], 'Northeast should contain all the diagonals');
echo 'tests done';
?>
--EXPECT--
tests done