--TEST--
Games_Chess->getPossibleBishopMoves() valid black #2
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->getPossibleBishopMoves('b7', 'B');
$phpunit->assertEquals(array('c6', 'd5', 'e4', 'f3', 'g2', 'a6'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done