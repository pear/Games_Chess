--TEST--
Games_Chess->getPossibleRookMoves() valid black #2
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->getPossibleRookMoves('b7', 'B');
$phpunit->assertEquals(array('b6', 'b5', 'b4', 'b3', 'b2'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done