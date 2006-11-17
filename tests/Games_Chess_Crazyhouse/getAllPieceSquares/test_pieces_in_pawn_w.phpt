--TEST--
Games_Chess_Crazyhouse->_getAllPieceSquares() multiple pieces (some promoted pawns) (white)
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'N', 'h5');
$board->addPiece('W', 'N', 'a5');
$board->addPiece('W', 'N', 'g4');
$phpunit->assertEquals(array('g4', 'h5', 'a5'), $board->_getAllPieceSquares('N', 'W'), 'white');
echo 'tests done';
?>
--EXPECT--
tests done