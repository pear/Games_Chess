--TEST--
Games_Chess_Crazyhouse->_getAllPieceSquares() no pieces of that color (white)
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'N', 'h5');
$phpunit->assertEquals(array(), $board->_getAllPieceSquares('N', 'W'), 'white');
echo 'tests done';
?>
--EXPECT--
tests done