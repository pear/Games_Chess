--TEST--
Games_Chess->getAllPieceSquares() no white pieces
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'N', 'h5');
$phpunit->assertEquals(array(), $board->_getAllPieceSquares('N', 'W'), 1);
echo 'tests done';
?>
--EXPECT--
tests done