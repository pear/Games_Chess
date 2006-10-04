--TEST--
Games_Chess->inCheckMate() valid checkmate
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->resetGame('rnbqkbnr/1pp1p2p/2P5/p2P1ppQ/8/8/PP1P1PPP/RNB1KBNR b KQkq - 2 6');
$phpunit->assertTrue($board->inCheckmate('B'), 'B');
$phpunit->assertFalse($board->inCheckmate('W'), 'W');
echo 'tests done';
?>
--EXPECT--
tests done