--TEST--
Games_Chess->getPossibleKnightMoves() valid white #1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->getPossibleKnightMoves('b1', 'W');
$phpunit->assertEquals(array('a3', 'c3'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done