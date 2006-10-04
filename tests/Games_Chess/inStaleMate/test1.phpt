--TEST--
Games_Chess->inStaleMate() pieces are pinned, causing stalemate
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'K', 'e8');
$board->addPiece('B', 'R', 'a8');
$board->addPiece('W', 'N', 'd8');
$board->addPiece('W', 'P', 'd7');
$board->addPiece('W', 'P', 'e7');
$board->addPiece('W', 'P', 'f7');
$board->addPiece('W', 'B', 'f8');
$board->addPiece('B', 'R', 'h8');
$board->addPiece('B', 'K', 'e1');
$phpunit->assertTrue($board->inStaleMate('W'), 'W');
$phpunit->assertFalse($board->inStaleMate('B'), 'B');
echo 'tests done';
?>
--EXPECT--
tests done