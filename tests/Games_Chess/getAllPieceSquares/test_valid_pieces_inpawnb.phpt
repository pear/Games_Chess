--TEST--
Games_Chess->getAllPieceSquares() 3 black pieces (1 is promoted pawn)
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'N', 'h5');
$board->addPiece('B', 'N', 'a5');
$board->addPiece('B', 'N', 'g4');
$phpunit->assertEquals(array('g4', 'h5', 'a5'), $board->_getAllPieceSquares('N', 'B'), 1);
echo 'tests done';
?>
--EXPECT--
tests done