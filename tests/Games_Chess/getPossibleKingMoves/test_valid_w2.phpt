--TEST--
Games_Chess->getPossibleKingMoves() valid white #2
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->getPossibleKingMoves('b2', 'W');
$phpunit->assertEquals(array('a3', 'c3', 'b3'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done