--TEST--
Games_Chess->getPossibleMoves() valid rook move
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->getPossibleMoves('R', 'e4', 'B');
$err2 = $board->getPossibleRookMoves('e4', 'B');
$phpunit->assertEquals($err2, $err, 'B');
$err = $board->getPossibleMoves('R', 'e4', 'W');
$err2 = $board->getPossibleRookMoves('e4', 'W');
$phpunit->assertEquals($err2, $err, 'W');
echo 'tests done';
?>
--EXPECT--
tests done