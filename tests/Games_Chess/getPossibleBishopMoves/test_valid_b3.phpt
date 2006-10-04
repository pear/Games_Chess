--TEST--
Games_Chess->getPossibleBishopMoves() valid black #2
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->getPossibleBishopMoves('e4', 'B');
$phpunit->assertEquals(array('f5', 'g6', 'd5', 'c6', 'f3', 'g2', 'd3', 'c2'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done