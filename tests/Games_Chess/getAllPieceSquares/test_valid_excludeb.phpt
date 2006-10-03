--TEST--
Games_Chess->getAllPieceSquares() 3 black pieces (exclude 1 piece)
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'N', 'h5');
$board->addPiece('B', 'N', 'a5');
$board->addPiece('B', 'N', 'g4');
$phpunit->assertEquals(array('h5', 'a5'), $board->_getAllPieceSquares('N', 'B', 'g4'), 1);
$phpunit->assertEquals(array('g4', 'h5'), $board->_getAllPieceSquares('N', 'B', 'a5'), 2);
$phpunit->assertEquals(array('g4', 'a5'), $board->_getAllPieceSquares('N', 'B', 'h5'), 3);
echo 'tests done';
?>
--EXPECT--
tests done