--TEST--
Games_Chess->getPossibleRookMoves() valid white #3
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame();
$err = $board->getPossibleRookMoves('e4', 'W');
$phpunit->assertEquals(array('e5', 'e6', 'e7', 'f4', 'g4', 'h4',
            'e3', 'd4', 'c4', 'b4', 'a4'), $err, 1);
echo 'tests done';
?>
--EXPECT--
tests done