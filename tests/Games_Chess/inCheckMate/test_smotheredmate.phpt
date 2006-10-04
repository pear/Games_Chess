--TEST--
Games_Chess->inCheckMate() smothered mate
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'N', 'f7');
$board->addPiece('B', 'K', 'h8');
$board->addPiece('W', 'K', 'h2');
$board->addPiece('B', 'P', 'h7');
$board->addPiece('B', 'P', 'g7');
$board->addPiece('B', 'R', 'g8');
$phpunit->assertTrue($board->inCheckmate('B'), 'B');
$phpunit->assertFalse($board->inCheckmate('W'), 'W');
echo 'tests done';
?>
--EXPECT--
tests done