--TEST--
Games_Chess->getAllPieceSquares() 1 black piece
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'N', 'h5');
$phpunit->assertEquals(array('h5'), $board->_getAllPieceSquares('N', 'B'), 1);
echo 'tests done';
?>
--EXPECT--
tests done