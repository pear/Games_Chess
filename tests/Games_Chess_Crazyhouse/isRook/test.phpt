--TEST--
Games_Chess_Crazyhouse->isRook()
--SKIPIF--
--FILE--
<?php
require_once dirname(__FILE__) . '/setup.php.inc';
$board->addPiece('W', 'R', 'e1');
$board->addPiece('W', 'R', 'e2');
$board->addPiece('W', 'R', 'e3');
$board->addPiece('W', 'B', 'e4');
$board->addPiece('W', 'P', 'e5');
$phpunit->assertTrue($board->isRook('WR0'), 'WR0');
$phpunit->assertTrue($board->isRook('WR1'), 'WR1');
$phpunit->assertFalse($board->isRook('WR2'), 'WR2');
$phpunit->assertTrue($board->isRook('WP0'), 'WP0');
$phpunit->assertFalse($board->isRook('WB0'), 'WB0');
$phpunit->assertFalse($board->isRook('WP1'), 'WP1');
echo 'tests done';
?>
--EXPECT--
tests done