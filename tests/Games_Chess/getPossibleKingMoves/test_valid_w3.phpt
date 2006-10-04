--TEST--
Games_Chess->getPossibleKingMoves() valid white #3
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->getPossibleKingMoves('e6', 'W');
$phpunit->assertEquals(array('d6', 'd7', 'd5', 'f6', 'f7', 'f5', 'e5', 'e7'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done