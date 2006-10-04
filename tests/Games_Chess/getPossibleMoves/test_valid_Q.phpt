--TEST--
Games_Chess->getPossibleMoves() valid queen move
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->getPossibleMoves('Q', 'e4', 'B');
$err2 = $board->getPossibleQueenMoves('e4', 'B');
$phpunit->assertEquals($err2, $err, 'B');
$err = $board->getPossibleMoves('Q', 'e4', 'W');
$err2 = $board->getPossibleQueenMoves('e4', 'W');
$phpunit->assertEquals($err2, $err, 'W');
echo 'tests done';
?>
--EXPECT--
tests done