--TEST--
Games_Chess->inCheckMate() double check checkmate
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'R', 'f8');
$board->addPiece('B', 'R', 'h8');
$board->addPiece('B', 'K', 'g8');
// add a piece that could interpose if it weren't double check
$board->addPiece('B', 'B', 'e8');

$board->addPiece('W', 'R', 'f1');
$board->addPiece('W', 'N', 'e7');
$board->addpiece('W', 'B', 'e4');
$board->addPiece('W', 'R', 'g1');
$board->addPiece('W', 'K', 'a1');
$phpunit->assertTrue($board->inCheckmate('B'), 'B');
$phpunit->assertFalse($board->inCheckmate('W'), 'W');
echo 'tests done';
?>
--EXPECT--
tests done