--TEST--
Games_Chess->getPossibleRookMoves() valid black #3
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->getPossibleRookMoves('e4', 'B');
$phpunit->assertEquals(array('e5', 'e6', 'f4', 'g4', 'h4', 'e3', 'e2', 'd4',
            'c4', 'b4', 'a4'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done