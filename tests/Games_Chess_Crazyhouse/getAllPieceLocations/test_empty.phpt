--TEST--
Games_Chess_Crazyhouse->_getAllPieceLocations() empty board
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$phpunit->assertEquals(array(), $board->_getAllPieceLocations('W'), 'white');
$phpunit->assertEquals(array(), $board->_getAllPieceLocations('B'), 'black');
echo 'tests done';
?>
--EXPECT--
tests done