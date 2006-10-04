--TEST--
Games_Chess->getPossibleKingMoves() valid white #1
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->getPossibleKingMoves('b1', 'W');
$phpunit->assertEquals(array(), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done