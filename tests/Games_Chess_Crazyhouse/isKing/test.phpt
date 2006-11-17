--TEST--
Games_Chess_Crazyhouse->isKing()
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'K', 'e1');
$board->addPiece('W', 'R', 'e4');
$board->addPiece('W', 'P', 'e5');
$phpunit->assertTrue($board->isKing('WK0'), 'WK0');
$phpunit->assertFalse($board->isKing('WK1'), 'WK1');
$phpunit->assertFalse($board->isKing('WP0'), 'WP0');
$phpunit->assertFalse($board->isKing('WR0'), 'WR0');
echo 'tests done';
?>
--EXPECT--
tests done