--TEST--
Games_Chess->_getDiagonals() e4
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$ret = $board->_getDiagonals('e4');
$phpunit->assertEquals(array('d3', 'c2', 'b1'),
    $ret['SW'], 'Southwest should should contain some diagonals');
$phpunit->assertEquals(array('f3', 'g2', 'h1'),
    $ret['SE'], 'Southeast should contain some diagonals');
$phpunit->assertEquals(array('d5', 'c6', 'b7', 'a8'),
    $ret['NW'], 'Northwest should should contain some diagonals');
$phpunit->assertEquals(array('f5', 'g6', 'h7'),
    $ret['NE'], 'Northeast should contain some diagonals');
echo 'tests done';
?>
--EXPECT--
tests done