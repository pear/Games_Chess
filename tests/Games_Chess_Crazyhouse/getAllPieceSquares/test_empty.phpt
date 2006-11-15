--TEST--
Games_Chess_Crazyhouse->_getAllPieceSquares() empty board
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$phpunit->assertEquals(array(), $board->_getAllPieceSquares('N', 'W'), 'white');
$phpunit->assertEquals(array(), $board->_getAllPieceSquares('N', 'B'), 'black');
echo 'tests done';
?>
--EXPECT--
tests done