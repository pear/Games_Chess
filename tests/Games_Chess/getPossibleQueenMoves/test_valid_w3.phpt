--TEST--
Games_Chess->getPossibleQueenMoves() valid white #3
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->getPossibleQueenMoves('e4', 'W');
$phpunit->assertEquals(array('e5', 'e6', 'e7', 'f4', 'g4', 'h4',
            'e3', 'd4', 'c4', 'b4', 'a4', 'f5', 'g6', 'h7',
            'd5', 'c6', 'b7', 'f3', 'd3'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done