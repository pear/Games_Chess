--TEST--
Games_Chess->getPossiblePawnMoves() valid white #2
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->getPossiblePawnMoves('b2', 'W');
$phpunit->assertEquals(array('b3', 'b4'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done