--TEST--
Games_Chess->getPossibleQueenMoves() valid black #2
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->getPossibleQueenMoves('b7', 'B');
$phpunit->assertEquals(array('b6', 'b5', 'b4', 'b3', 'b2', 'c6', 'd5', 'e4',
            'f3', 'g2', 'a6'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done