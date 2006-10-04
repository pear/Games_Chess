--TEST--
Games_Chess->getPossibleBishopMoves() valid white #2
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->getPossibleBishopMoves('b2', 'W');
$phpunit->assertEquals(array('c3', 'd4', 'e5', 'f6', 'g7', 'a3'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done