--TEST--
Games_Chess->getPossibleBishopMoves() valid white #3
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->getPossibleBishopMoves('e4', 'W');
$phpunit->assertEquals(array('f5', 'g6', 'h7', 'd5', 'c6', 'b7',
            'f3', 'd3'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done