--TEST--
Games_Chess_Crazyhouse->_getAllPieceSquares() 1 piece (black)
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'N', 'h5');
$phpunit->assertEquals(array('h5'), $board->_getAllPieceSquares('N', 'B'), 'white');
echo 'tests done';
?>
--EXPECT--
tests done