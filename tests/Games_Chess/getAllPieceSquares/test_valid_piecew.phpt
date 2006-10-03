--TEST--
Games_Chess->getAllPieceSquares() 1 white piece
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'N', 'h5');
$phpunit->assertEquals(array('h5'), $board->_getAllPieceSquares('N', 'W'), 1);
echo 'tests done';
?>
--EXPECT--
tests done