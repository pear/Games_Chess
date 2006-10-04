--TEST--
Games_Chess->getPossibleKnightMoves() valid black #1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->getPossibleKnightMoves('b8', 'B');
$phpunit->assertEquals(array('c6', 'a6'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done