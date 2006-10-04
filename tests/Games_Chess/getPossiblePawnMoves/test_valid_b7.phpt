--TEST--
Games_Chess->getPossiblePawnMoves() valid black #7
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'P', 'a6');
$board->addPiece('B', 'P', 'c6');
$err = $board->getPossiblePawnMoves('b7', 'B');
$phpunit->assertEquals(array('b6', 'b5'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done