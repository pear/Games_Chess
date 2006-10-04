--TEST--
Games_Chess->getPossibleQueenMoves() valid black #3
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->getPossibleQueenMoves('e4', 'B');
$phpunit->assertEquals(array('e5', 'e6', 'f4', 'g4', 'h4', 'e3', 'e2', 'd4',
            'c4', 'b4', 'a4', 'f5', 'g6', 'd5', 'c6', 'f3', 'g2', 'd3', 'c2'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done