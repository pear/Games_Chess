--TEST--
Games_Chess->getAllPieceSquares() no pieces
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$phpunit->assertEquals(array(), $board->_getAllPieceSquares('N', 'W'), 1);
$phpunit->assertEquals(array(), $board->_getAllPieceSquares('N', 'B'), 2);
echo 'tests done';
?>
--EXPECT--
tests done