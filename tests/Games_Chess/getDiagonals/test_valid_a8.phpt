--TEST--
Games_Chess->_getDiagonals() a8
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_getDiagonals('a8');
$phpunit->assertEquals(false, $ret['NW'], 'Northwest should not exist');
$phpunit->assertEquals(false, $ret['SW'], 'Southwest should not exist');
$phpunit->assertEquals(false, $ret['NE'], 'Northeast should not exist');
$phpunit->assertEquals(array('b7', 'c6', 'd5', 'e4', 'f3', 'g2', 'h1'),
    $ret['SE'], 'Southeast should contain all the diagonals');
echo 'tests done';
?>
--EXPECT--
tests done