--TEST--
Games_Chess->getPossibleKnightMoves() valid black #2
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->getPossibleKnightMoves('e5', 'B');
$phpunit->assertEquals(array('c6', 'g6', 'g4', 'f3', 'd3', 'c4'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done