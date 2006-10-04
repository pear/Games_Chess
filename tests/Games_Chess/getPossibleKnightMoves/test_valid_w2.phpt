--TEST--
Games_Chess->getPossibleKnightMoves() valid white #2
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->getPossibleKnightMoves('e4', 'W');
$phpunit->assertEquals(array('c5', 'd6', 'f6', 'g5', 'g3', 'c3'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done