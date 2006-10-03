--TEST--
Games_Chess->getAllPieceSquares() 3 white pieces (exclude 1 piece)
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'N', 'h5');
$board->addPiece('W', 'N', 'a5');
$board->addPiece('W', 'N', 'g4');
$phpunit->assertEquals(array('h5', 'a5'), $board->_getAllPieceSquares('N', 'W', 'g4'), 1);
$phpunit->assertEquals(array('h5', 'g4'), $board->_getAllPieceSquares('N', 'W', 'a5'), 2);
$phpunit->assertEquals(array('a5', 'g4'), $board->_getAllPieceSquares('N', 'W', 'h5'), 3);
echo 'tests done';
?>
--EXPECT--
tests done