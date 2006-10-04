--TEST--
Games_Chess->inCheckMate() king can move out of check
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('B', 'R', 'f8');
$board->addPiece('B', 'R', 'h8');
$board->addPiece('B', 'K', 'g8');

$board->addPiece('W', 'R', 'f1');
$board->addPiece('W', 'R', 'g1');
$board->addPiece('W', 'K', 'a1');
$phpunit->assertFalse($board->inCheckmate('B'), 'B');
$phpunit->assertFalse($board->inCheckmate('W'), 'W');
echo 'tests done';
?>
--EXPECT--
tests done