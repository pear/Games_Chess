--TEST--
Games_Chess->_getDiagonals() h8
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_getDiagonals('h8');
$phpunit->assertEquals(false, $ret['NW'], 'Northwest should not exist');
$phpunit->assertEquals(false, $ret['SE'], 'Southeast should not exist');
$phpunit->assertEquals(false, $ret['NE'], 'Northeast should not exist');
$phpunit->assertEquals(array('g7', 'f6', 'e5', 'd4', 'c3', 'b2', 'a1'),
    $ret['SW'], 'Southwest should contain all the diagonals');
echo 'tests done';
?>
--EXPECT--
tests done