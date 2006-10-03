--TEST--
Games_Chess->getAllPieceSquares() 2 black pieces
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'N', 'h5');
$board->addPiece('B', 'N', 'a5');
$phpunit->assertEquals(array('h5', 'a5'), $board->_getAllPieceSquares('N', 'B'), 1);
echo 'tests done';
?>
--EXPECT--
tests done