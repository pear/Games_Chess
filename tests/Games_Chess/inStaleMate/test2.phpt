--TEST--
Games_Chess->inStaleMate() no pieces can move, stalemate
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'P', 'g4');
$board->addPiece('B', 'P', 'g5');
$board->addPiece('W', 'P', 'g3');
$board->addPiece('W', 'K', 'h3');
$board->addPiece('W', 'P', 'h2');
$board->addPiece('W', 'P', 'g2');
$board->addPiece('B', 'K', 'e8');
$phpunit->assertTrue($board->inStaleMate('W'), 'W');
$phpunit->assertFalse($board->inStaleMate('B'), 'B');
echo 'tests done';
?>
--EXPECT--
tests done