--TEST--
Games_Chess->getPossibleMoves() valid bishop move
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->getPossibleMoves('B', 'e4', 'B');
$err2 = $board->getPossibleBishopMoves('e4', 'B');
$phpunit->assertEquals($err2, $err, 'B');
$err = $board->getPossibleMoves('B', 'e4', 'W');
$err2 = $board->getPossibleBishopMoves('e4', 'W');
$phpunit->assertEquals($err2, $err, 'W');
echo 'tests done';
?>
--EXPECT--
tests done