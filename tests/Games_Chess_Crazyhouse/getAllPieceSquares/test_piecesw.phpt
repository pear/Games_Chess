--TEST--
Games_Chess_Crazyhouse->_getAllPieceSquares() multiple pieces (white)
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'N', 'h5');
$board->addPiece('W', 'N', 'a5');
$phpunit->assertEquals(array('h5', 'a5'), $board->_getAllPieceSquares('N', 'W'), 'white');
echo 'tests done';
?>
--EXPECT--
tests done