--TEST--
Games_Chess_Crazyhouse->_getAllPieceSquares() multiple pieces (black)
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'N', 'h5');
$board->addPiece('B', 'N', 'a5');
$phpunit->assertEquals(array('h5', 'a5'), $board->_getAllPieceSquares('N', 'B'), 'black');
echo 'tests done';
?>
--EXPECT--
tests done