--TEST--
Games_Chess_Crazyhouse->_getAllPieceSquares() 1 piece (white)
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'N', 'h5');
$phpunit->assertEquals(array('h5'), $board->_getAllPieceSquares('N', 'W'), 'white');
echo 'tests done';
?>
--EXPECT--
tests done