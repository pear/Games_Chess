--TEST--
Games_Chess->getAllPieceSquares() 3 white pieces (1 is promoted pawn)
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'N', 'h5');
$board->addPiece('W', 'N', 'a5');
$board->addPiece('W', 'N', 'g4');
$phpunit->assertEquals(array('h5', 'a5', 'g4'), $board->_getAllPieceSquares('N', 'W'), 1);
echo 'tests done';
?>
--EXPECT--
tests done