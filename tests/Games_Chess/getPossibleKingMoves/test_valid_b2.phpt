--TEST--
Games_Chess->getPossibleKingMoves() valid black #2
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->getPossibleKingMoves('b7', 'B');
$phpunit->assertEquals(array('a6', 'c6', 'b6'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done