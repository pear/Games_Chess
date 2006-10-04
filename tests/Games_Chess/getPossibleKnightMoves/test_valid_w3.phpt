--TEST--
Games_Chess->getPossibleKnightMoves() valid white #2
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->getPossibleKnightMoves('e5', 'W');
$phpunit->assertEquals(array('c6', 'd7', 'f7', 'g6', 'g4', 'f3', 'd3', 'c4'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done