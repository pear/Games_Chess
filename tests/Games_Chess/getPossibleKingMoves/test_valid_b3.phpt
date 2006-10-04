--TEST--
Games_Chess->getPossibleKingMoves() valid black #3
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->getPossibleKingMoves('e3', 'B');
$phpunit->assertEquals(array('d3', 'd4', 'd2', 'f3', 'f4', 'f2', 'e2', 'e4'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done