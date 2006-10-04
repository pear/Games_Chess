--TEST--
Games_Chess->getPossibleKnightMoves() valid black #3
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->getPossibleKnightMoves('e4', 'B');
$phpunit->assertEquals(array('c5', 'd6', 'f6', 'g5', 'g3', 'f2', 'd2', 'c3'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done