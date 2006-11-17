--TEST--
Games_Chess_Crazyhouse->_getAllPieceSquares() multiple pieces (some promoted pawns) (black)
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'N', 'h5');
$board->addPiece('B', 'N', 'a5');
$board->addPiece('B', 'N', 'g4');
$phpunit->assertEquals(array('g4', 'h5', 'a5'), $board->_getAllPieceSquares('N', 'B'), 'white');
echo 'tests done';
?>
--EXPECT--
tests done